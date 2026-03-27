<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Pemesanan;
use App\Models\DetailPemesanan;
use App\Models\Pembayaran;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

class OrderController extends Controller
{
    /**
     * Tampilkan halaman checkout dengan cart items
     */
    public function checkout()
    {
        $customer = Auth::guard('customer')->user();

        // Ambil semua items di cart customer
        $cartItems = Cart::with('produk')
            ->where('customerId', $customer->customerId)
            ->get();

        if($cartItems->isEmpty()){
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang Anda kosong.');
        }

        $total = $cartItems->sum(function($item){
            return ($item->produk->price ?? 0) * $item->qty;
        });

        $midtransClientKey = config('midtrans.client_key');

        return view('landing.order.checkout', compact('cartItems', 'total', 'customer', 'midtransClientKey'));
    }

    /**
     * Proses pemesanan dan bayar
     */
    public function process(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        // Validasi input
        $request->validate([
            'nama_penerima' => 'required|string|max:100',
            'no_telp_penerima' => 'required|string|max:20',
            'alamat_pengiriman' => 'required|string',
            'metodePembayaran' => 'required|string',
        ]);

        // Ambil cart items
        $cartItems = Cart::with('produk')
            ->where('customerId', $customer->customerId)
            ->get();

        if($cartItems->isEmpty()){
            return redirect()->route('cart.index')
                ->with('error', 'Keranjang kosong.');
        }

        // Hitung total
        $total = $cartItems->sum(function($item){
            return ($item->produk->price ?? 0) * $item->qty;
        });

        // Generate pemesanan ID (PM001, PM002, dll)
        $lastPemesanan = Pemesanan::orderBy('pemesananId', 'desc')->first();
        $number = 1;
        if($lastPemesanan) {
            $number = intval(substr($lastPemesanan->pemesananId, 2)) + 1;
        }
        $pemesananId = 'PM' . str_pad($number, 3, '0', STR_PAD_LEFT);

        // Buat record pemesanan
        $pemesanan = Pemesanan::create([
            'pemesananId' => $pemesananId,
            'customerId' => $customer->customerId,
            'date' => date('Y-m-d'),
            'totalPrice' => $total,
            'nama_penerima' => $request->nama_penerima,
            'no_telp_penerima' => $request->no_telp_penerima,
            'alamat_pengiriman' => $request->alamat_pengiriman,
        ]);

        // Generate dan buat detail pemesanan untuk setiap item
        $detailNumber = 1;
        $lastDetail = DetailPemesanan::orderBy('detailPemesananId', 'desc')->first();
        if($lastDetail) {
            $detailNumber = intval(substr($lastDetail->detailPemesananId, 2)) + 1;
        }

        foreach($cartItems as $item) {
            $detailId = 'DP' . str_pad($detailNumber, 3, '0', STR_PAD_LEFT);
            $detailNumber++;

            DetailPemesanan::create([
                'detailPemesananId' => $detailId,
                'pemesananId' => $pemesananId,
                'produkId' => $item->produkId,
                'hargaSatuan' => $item->produk->price ?? 0,
                'qty' => $item->qty
            ]);

            // Update stok produk (kurangi qty)
            $produk = Produk::find($item->produkId);
            if($produk) {
                $produk->update([
                    'qty' => $produk->qty - $item->qty
                ]);
            }
        }

        // Generate pembayaran ID (PY001, PY002, dll)
        $lastPembayaran = Pembayaran::orderBy('pembayaranId', 'desc')->first();
        $payNumber = 1;
        if($lastPembayaran) {
            $payNumber = intval(substr($lastPembayaran->pembayaranId, 2)) + 1;
        }
        $pembayaranId = 'PY' . str_pad($payNumber, 3, '0', STR_PAD_LEFT);

        // Buat record pembayaran
        Pembayaran::create([
            'pembayaranId' => $pembayaranId,
            'customerId' => $customer->customerId,
            'pemesananId' => $pemesananId,
            'chatDokterId' => null,
            'amount' => $total,
            'metodePembayaran' => $request->metodePembayaran,
            'date' => date('Y-m-d'),
            'status' => 'pending'
        ]);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $pemesananId,
                'gross_amount' => (int)$total,
            ],
            'customer_details' => [
                'first_name' => $request->nama_penerima,
                'email' => $customer->email ?? $customer->username . '@example.com', // Opsional, sesuaikan field email di tabel customer
                'phone' => $request->no_telp_penerima,
            ],
            // 'enabled_payments' => ['credit_card', 'gopay', 'shopeepay', 'permata_va', 'bca_va', 'bni_va', 'bri_va', 'other_va'], // Opsional
        ];

        try {
            // Hapus cart items customer ini sebelum redirect (atau tunggu callback, tapi biasanya dihapus saat order dibuat)
            Cart::where('customerId', $customer->customerId)->delete();

            $snapToken = Snap::getSnapToken($params);
            
            if ($request->ajax()) {
                return response()->json([
                    'snap_token' => $snapToken,
                    'order_id' => $pemesananId
                ]);
            }

            return redirect()->route('order.success', $pemesananId)->with('snap_token', $snapToken);
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()], 500);
            }
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan halaman sukses pemesanan
     */
    public function success($pemesananId)
    {
        $pemesanan = Pemesanan::with(['detailPemesanan.produk', 'pembayaran'])
            ->findOrFail($pemesananId);

        // Validasi bahwa pemesanan milik user yang sedang login
        $customer = Auth::guard('customer')->user();
        if($pemesanan->customerId !== $customer->customerId) {
            abort(403, 'Unauthorized');
        }

        return view('landing.order.success', compact('pemesanan'));
    }

    /**
     * Tampilkan halaman riwayat pesanan
     */
    public function history()
    {
        $customer = Auth::guard('customer')->user();

        $pemesanan = Pemesanan::with(['detailPemesanan.produk', 'pembayaran'])
            ->where('customerId', $customer->customerId)
            ->orderBy('date', 'desc')
            ->get();

        return view('landing.order.history', compact('pemesanan'));
    }
}
