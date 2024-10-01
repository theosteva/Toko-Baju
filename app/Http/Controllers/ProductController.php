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
        $tags = Tag::all();
        $newProducts = Product::latest()->take(9)->get();

        return view('products.categories', compact('tags', 'newProducts'));
    }

    public function allProducts()
    {
        $products = Product::with('tags')->get();
        return response()->json($products);
    }

    public function home()
    {
        $featuredProducts = Product::with('tags')->featured()->take(6)->get();
        return view('home', compact('featuredProducts'));
    }

    public function getProductsByTag(Request $request)
    {
        $tag = $request->query('tag');
        
        if ($tag === 'new') {
            $products = Product::latest()->take(9)->get();
        } else {
            $products = Product::whereHas('tags', function ($query) use ($tag) {
                $query->where('name', $tag);
            })->get();
        }

        return response()->json($products);
    }
}
