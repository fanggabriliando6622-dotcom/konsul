<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // ===============================
    // VIEW CART
    // ===============================
    public function index()
{
    $customer = Auth::guard('customer')->user();

    $cartItems = Cart::with('produk')
        ->where('customerId', $customer->customerId) // WAJIB ADA
        ->get();

    $total = $cartItems->sum(function($item){
        return $item->produk->price * $item->qty;
    });

    return view('landing.cart.cart', compact('cartItems','total'));
}


    // ===============================
    // ADD TO CART
    // ===============================
    public function add(Request $request)
    {
        $customer = Auth::guard('customer')->user();

        $request->validate([
            'produk_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        // Validasi stok produk
        $produk = Produk::findOrFail($request->produk_id);
        
        $cart = Cart::where('customerId', $customer->customerId)
                    ->where('produkId', $request->produk_id)
                    ->first();

        $newQty = $cart ? $cart->qty + $request->qty : $request->qty;

        if ($newQty > $produk->qty) {
            return response()->json(['success' => false, 'error' => 'Jumlah melebihi stok tersedia'], 400);
        }

        if($cart){
            $cart->update(['qty' => $newQty]);
        }else{
            Cart::create([
                'customerId' => $customer->customerId,
                'produkId'   => $request->produk_id,
                'qty'        => $newQty
            ]);
        }

        // Build response with cart count and items
        $items = Cart::where('customerId', $customer->customerId)
            ->with('produk')
            ->get();

        $cart_count = $items->sum('qty');

        $cart = [];
        foreach ($items as $it) {
            $cart[$it->produkId] = [
                'produk_id' => $it->produkId,
                'name' => $it->produk->produkName ?? '',
                'price' => $it->produk->price ?? 0,
                'quantity' => $it->qty,
                'gambar' => $it->produk->gambar ?? ''
            ];
        }

        return response()->json([
            'success' => true,
            'cart_count' => $cart_count,
            'cart' => $cart
        ]);
    }

    // ===============================
    // UPDATE QTY
    // ===============================
    public function update(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();

        $cart = Cart::where('id',$id)
            ->where('customerId',$customer->customerId)
            ->firstOrFail();

        // Validasi stok produk
        $produk = Produk::findOrFail($cart->produkId);
        if ($request->qty > $produk->qty) {
            return response()->json(['success' => false, 'error' => 'Jumlah melebihi stok tersedia'], 400);
        }

        $cart->update([
            'qty' => $request->qty
        ]);

        return response()->json(['success'=>true]);
    }

    // ===============================
    // REMOVE
    // ===============================
    public function destroy($id)
    {
        $customer = Auth::guard('customer')->user();

        Cart::where('id',$id)
            ->where('customerId',$customer->customerId)
            ->delete();

        return response()->json(['success'=>true]);
    }
}
