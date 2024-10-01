<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu'], 401);
        }

        $product = Product::findOrFail($request->product_id);

        $cartItem = Cart::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id],
            ['quantity' => $request->quantity]
        );

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart_item' => $cartItem
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'You must be logged in first'], 401);
        }

        $deleted = Cart::where('user_id', $user->id)
                       ->where('product_id', $request->product_id)
                       ->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Product successfully removed from cart'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in cart'
            ]);
        }
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $cartItems = Cart::with('product')->where('user_id', $user->id)->get();

        return view('cart.index', compact('cartItems'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['message' => 'Anda harus login terlebih dahulu'], 401);
        }

        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $request->product_id)
            ->firstOrFail();

        $cartItem->update(['quantity' => $request->quantity]);

        return response()->json([
            'message' => 'Jumlah produk berhasil diperbarui',
            'cart_item' => $cartItem
        ]);
    }
}
