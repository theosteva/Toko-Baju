@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Keranjang Belanja</h1>

    @if($cartItems->count() > 0)
        <div class="bg-white rounded-lg shadow-md p-6">
            @foreach($cartItems as $item)
                <div class="flex items-center justify-between border-b py-4">
                    <div class="flex items-center">
                        <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}" class="w-16 h-16 object-cover rounded">
                        <div class="ml-4">
                            <h2 class="text-lg font-semibold">{{ $item->product->name }}</h2>
                            <p class="text-gray-600">Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <input type="number" min="1" value="{{ $item->quantity }}" onchange="updateQuantity({{ $item->product->id }}, this.value)" class="w-16 px-2 py-1 border rounded mr-4">
                        <button onclick="removeFromCart({{ $item->product->id }})" class="text-red-500 hover:text-red-600 transition">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
            @endforeach
            <div class="mt-8">
                <h3 class="text-xl font-semibold">Total: Rp {{ number_format($cartItems->sum(function($item) { return $item->product->price * $item->quantity; }), 0, ',', '.') }}</h3>
                <button class="mt-4 bg-green-500 text-white px-6 py-3 rounded hover:bg-green-600 transition">
                    Lanjutkan ke Pembayaran
                </button>
            </div>
        </div>
    @else
        <p class="text-gray-600">Keranjang belanja Anda masih kosong.</p>
    @endif
</div>

<script>
function updateQuantity(productId, quantity) {
    // Implementasi logika untuk memperbarui jumlah
}

function removeFromCart(productId) {
    // Implementasi logika untuk menghapus dari keranjang
}
</script>
@endsection