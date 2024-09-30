<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('tags')->paginate(12);
        return view('products.home', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('tags');
        
        // Perbaiki logika untuk mendapatkan produk terkait
        $relatedProducts = Product::where('products.id', '!=', $product->id)
            ->whereHas('tags', function ($query) use ($product) {
                $query->whereIn('tags.id', $product->tags->pluck('id'));
            })
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }

    public function categories()
    {
        $categories = [
            'Dresses', 'Tops', 'Bottoms', 'Outerwear', 'Accessories'
        ];

        $newProducts = Product::latest()->take(9)->get();

        return view('products.categories', compact('categories', 'newProducts'));
    }

    public function allProducts()
    {
        $products = Product::with('tags')->get();
        return response()->json($products);
    }
}
