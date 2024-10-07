@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-16 max-w-7xl"> <!-- Set max-width for large screens -->
    <h1 class="text-4xl font-bold mb-12 text-center">Fill Your Details</h1> <!-- Centered heading -->

    <div class="flex flex-col lg:flex-row gap-12 items-start justify-between"> <!-- Flexbox for two-column layout on large screens -->

        <!-- Product Details -->
        <div class="bg-white rounded-lg shadow-lg p-8 lg:w-1/2 w-full">
            <h2 class="text-3xl font-bold mb-8 text-gray-800">Product Details</h2>
            <div class="mb-6">
                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-80 object-cover rounded-lg shadow-sm mb-6">
            </div>
            <h3 class="text-2xl font-semibold text-gray-800">{{ $product->name }}</h3>
            <span class="text-3xl font-bold text-green-600">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
            <p class="mt-4 text-lg text-gray-800">Selected Size: <strong>{{ request()->get('size') }}</strong></p>
        </div>

        <!-- Buyer Details Form -->
        <div class="bg-white rounded-lg shadow-lg p-8 lg:w-1/2 w-full">
            <h2 class="text-3xl font-bold mb-8 text-gray-800">Buyer Form</h2>
            <form id="buyerForm" action="{{ route('payment.process', $product->id) }}" method="POST" class="space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" name="first_name" id="first_name" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" name="last_name" id="last_name" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                    </div>
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" id="email" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" id="phone" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Address Form -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Address</label>
                    <input type="text" name="address" id="address" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                </div>
                <div>
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                    <input type="text" name="city" id="city" required class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 transition">
                </div>

                <!-- Payment Button -->
                <button type="submit" class="w-full bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-300">
                    Continue to Payment
                </button>

                <!-- Hidden Fields for Product Data -->
                <input type="hidden" name="product_name" value="{{ $product->name }}">
                <input type="hidden" name="product_price" value="{{ $product->price }}">
                <input type="hidden" name="selected_size" value="{{ request()->get('size') }}">
            </form>
        </div>
    </div>
</div>
@endsection
