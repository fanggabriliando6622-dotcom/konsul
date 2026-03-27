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

        if ($customer) {
            $cartItems = Cart::with('produk')
                ->where('customerId', $customer->customerId)
                ->get();
        } else {
            // Guest mode: load products from 'cart' session
            $sessionCart = session()->get('cart', []);
            $cartItems = collect();
            
            foreach ($sessionCart as $produkId => $item) {
                $produk = Produk::find($produkId);
                if ($produk) {
                    $cartItems->push((object)[
                        'id' => $produkId, 
                        'produkId' => $produkId,
                        'qty' => $item['quantity'],
                        'produk' => $produk
                    ]);
                }
            }
        }

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
        $request->validate([
            'produk_id' => 'required',
            'qty' => 'required|integer|min:1'
        ]);

        $produk = Produk::findOrFail($request->produk_id);
        if ($request->qty > $produk->qty) {
            return response()->json(['success' => false, 'error' => 'Jumlah melebihi stok tersedia'], 400);
        }

        $customer = Auth::guard('customer')->user();

        if ($customer) {
            // Logged in user: DB cart
            $cart = Cart::where('customerId', $customer->customerId)
                        ->where('produkId', $request->produk_id)
                        ->first();

            if($cart){
                $cart->update(['qty' => $request->qty]);
            }else{
                Cart::create([
                    'customerId' => $customer->customerId,
                    'produkId'   => $request->produk_id,
                    'qty'        => $request->qty
                ]);
            }
        } else {
            // Guest user: session cart
            $sessionCart = session()->get('cart', []);
            $sessionCart[$request->produk_id] = [
                'name' => $produk->produkName,
                'quantity' => $request->qty,
                'price' => $produk->price,
                'gambar' => $produk->gambar
            ];
            session()->put('cart', $sessionCart);
        }

        // Build response with cart count and items
        return $this->getCartResponse();
    }

    // ===============================
    // UPDATE QTY
    // ===============================
    public function update(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            $cart = Cart::where('id', $id)
                ->where('customerId', $customer->customerId)
                ->firstOrFail();

            $produk = Produk::findOrFail($cart->produkId);
            if ($request->qty > $produk->qty) {
                return response()->json(['success' => false, 'error' => 'Stok tidak cukup'], 400);
            }

            $cart->update(['qty' => $request->qty]);
        } else {
            // $id for guest is produkId
            $produk = Produk::find($id);
            if (!$produk) return response()->json(['success' => false], 404);
            
            if ($request->qty > $produk->qty) {
                return response()->json(['success' => false, 'error' => 'Stok tidak cukup'], 400);
            }

            $sessionCart = session()->get('cart', []);
            if (isset($sessionCart[$id])) {
                $sessionCart[$id]['quantity'] = $request->qty;
                session()->put('cart', $sessionCart);
            }
        }

        return response()->json(['success' => true]);
    }

    // ===============================
    // REMOVE
    // ===============================
    public function destroy($id)
    {
        $customer = Auth::guard('customer')->user();

        if ($customer) {
            Cart::where('id', $id)
                ->where('customerId', $customer->customerId)
                ->delete();
        } else {
            // $id for guest is produkId
            $sessionCart = session()->get('cart', []);
            if (isset($sessionCart[$id])) {
                unset($sessionCart[$id]);
                session()->put('cart', $sessionCart);
            }
        }

        return response()->json(['success' => true]);
    }

    // HELPER FOR AJAX RESPONSE
    private function getCartResponse()
    {
        $customer = Auth::guard('customer')->user();
        $items = collect();

        if ($customer) {
            $dbItems = Cart::where('customerId', $customer->customerId)->with('produk')->get();
            foreach ($dbItems as $it) {
                $items->push((object)[
                    'produkId' => $it->produkId,
                    'name' => $it->produk->produkName,
                    'price' => $it->produk->price,
                    'qty' => $it->qty,
                    'gambar' => $it->produk->gambar
                ]);
            }
        } else {
            $sessionCart = session()->get('cart', []);
            foreach ($sessionCart as $pid => $item) {
                $items->push((object)[
                    'produkId' => $pid,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'qty' => $item['quantity'],
                    'gambar' => $item['gambar']
                ]);
            }
        }

        $cart_count = $items->sum('qty');
        $cart_data = [];
        foreach ($items as $item) {
            $cart_data[$item->produkId] = [
                'produk_id' => $item->produkId,
                'name' => $item->name,
                'price' => $item->price,
                'quantity' => $item->qty,
                'gambar' => $item->gambar
            ];
        }

        return response()->json([
            'success' => true,
            'cart_count' => $cart_count,
            'cart' => $cart_data
        ]);
    }
}
