@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="bg-white rounded-lg shadow-md overflow-hidden mb-8">
        <div class="md:flex">
            <!-- Main Image Section -->
            <div class="md:w-2/3 p-4">
                <div class="mb-4">
                    <img id="mainImage" src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/placeholder-image.jpg') }}" alt="{{ $product->name }}" class="w-full h-96 object-contain rounded-lg">
                </div>
                <!-- Thumbnails -->
                <div class="flex justify-center space-x-2 mt-4">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/placeholder-image.jpg') }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg cursor-pointer thumbnail" data-image="{{ $product->image ? asset('storage/' . $product->image) : asset('path/to/placeholder-image.jpg') }}">
                    @if ($product->image2)
                        <img src="{{ asset('storage/' . $product->image2) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg cursor-pointer thumbnail" data-image="{{ asset('storage/' . $product->image2) }}">
                    @endif
                    @if ($product->image3)
                        <img src="{{ asset('storage/' . $product->image3) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg cursor-pointer thumbnail" data-image="{{ asset('storage/' . $product->image3) }}">
                    @endif
                    @if ($product->image4)
                        <img src="{{ asset('storage/' . $product->image4) }}" alt="{{ $product->name }}" class="w-24 h-24 object-cover rounded-lg cursor-pointer thumbnail" data-image="{{ asset('storage/' . $product->image4) }}">
                    @endif
                </div>
            </div>

            <!-- Product Details Section -->
            <div class="md:w-1/3 p-8">
                <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                <p class="text-gray-600 mb-4">{{ $product->description }}</p>
                
                <div class="mt-4">
                    <h3 class="text-lg font-semibold">Tags:</h3>
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach ($product->tags as $tag)
                            <span class="px-2 py-1 bg-gray-200 rounded-full text-sm">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex justify-between items-center mt-4">
                    <span class="text-2xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                    <span class="text-gray-600">Stok: {{ $product->stock }}</span>
                </div>
                
                <!-- Size Selection -->
                <div class="mt-4">
                    <h3 class="text-lg font-semibold mb-2">Pilih Ukuran:</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach (['S', 'M', 'L', 'XL', 'XXL'] as $size)
                            <button class="size-button px-4 py-2 border border-gray-300 rounded-md hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                <button class="mt-6 bg-yellow-500 text-white px-6 py-2 rounded hover:bg-yellow-600 w-full">Beli Sekarang</button>
            </div>
        </div>
    </div>

    <!-- You might also like this section -->
    <div class="mt-12">
        <h2 class="text-2xl font-bold mb-4">Anda Mungkin Juga Suka</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            @foreach ($relatedProducts as $relatedProduct)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <a href="{{ route('products.show', $relatedProduct) }}">
                        <img src="{{ $relatedProduct->image ? asset('storage/' . $relatedProduct->image) : asset('path/to/placeholder-image.jpg') }}" alt="{{ $relatedProduct->name }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold mb-2">{{ $relatedProduct->name }}</h3>
                            <p class="text-gray-600 mb-2 truncate">{{ $relatedProduct->description }}</p>
                            <span class="text-yellow-500 font-bold">Rp {{ number_format($relatedProduct->price, 0, ',', '.') }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <a href="{{ route('products.home') }}" class="mt-8 inline-block text-blue-500 hover:underline">&larr; Kembali ke daftar produk</a>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const mainImage = document.getElementById('mainImage');
    const thumbnails = document.querySelectorAll('.thumbnail');
    const sizeButtons = document.querySelectorAll('.size-button');

    thumbnails.forEach(thumbnail => {
        thumbnail.addEventListener('click', function() {
            const newImageSrc = this.getAttribute('data-image');
            mainImage.src = newImageSrc;
        });
    });

    sizeButtons.forEach(button => {
        button.addEventListener('click', function() {
            sizeButtons.forEach(btn => btn.classList.remove('bg-yellow-500', 'text-white'));
            this.classList.add('bg-yellow-500', 'text-white');
        });
    });
});
</script>
@endsection
