@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Wishlist Saya</h1>

    @if($wishlistItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($wishlistItems as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h2 class="text-xl font-semibold mb-2">{{ $item->product->name }}</h2>
                        <p class="text-gray-600 mb-4">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        <div class="flex justify-between items-center">
                            <button onclick="addToCart({{ $item->product->id }})" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                Tambah ke Keranjang
                            </button>
                            <button onclick="removeFromWishlist({{ $item->product->id }})" class="text-red-500 hover:text-red-600 transition">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600">Wishlist Anda masih kosong.</p>
    @endif
</div>

<script>
function addToCart(productId) {
    // Implementasi logika untuk menambahkan ke keranjang
}

function removeFromWishlist(productId) {
    // Implementasi logika untuk menghapus dari wishlist
}
</script>
@endsection