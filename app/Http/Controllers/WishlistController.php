<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'Anda harus login terlebih dahulu'], 401);
        }

        $product = Product::findOrFail($request->product_id);

        $wishlistItem = Wishlist::updateOrCreate(
            ['user_id' => $user->id, 'product_id' => $product->id]
        );

        return response()->json([
            'success' => true,
            'message' => 'Produk berhasil ditambahkan ke wishlist',
            'wishlist_item' => $wishlistItem
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

        $deleted = Wishlist::where('user_id', $user->id)
                       ->where('product_id', $request->product_id)
                       ->delete();

        if ($deleted) {
            return response()->json([
                'success' => true,
                'message' => 'Product successfully removed from wishlist'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Product not found in wishlist'
            ]);
        }
    }

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('login');
        }

        $wishlistItems = Wishlist::with('product')->where('user_id', $user->id)->get();

        return view('wishlist.index', compact('wishlistItems'));
    }
}
