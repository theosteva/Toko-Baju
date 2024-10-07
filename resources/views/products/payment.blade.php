@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-12 flex flex-col items-center"> 
    <!-- Page Heading -->
    <h1 class="text-3xl font-bold mb-6 text-center">Your payment will show in a second automatically, please wait...</h1> 
    <h3 class="text-xl mb-10 text-center">If the payment doesn't show up, please press "Pay Now".</h3>

    <!-- Product Image Display -->
    <div class="mb-8">
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full max-w-xs rounded-lg shadow-lg">
    </div>

    <!-- Payment Details -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mb-10">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Payment Details</h2>
        <p class="text-lg text-gray-700 text-center mb-2"><strong>Product Name:</strong> {{ $request->input('product_name') }}</p>
        <p class="text-lg text-gray-700 text-center mb-2"><strong>Product Price:</strong> Rp {{ number_format($request->input('product_price'), 0, ',', '.') }}</p>
        <p class="text-lg text-gray-700 text-center"><strong>Selected Size:</strong> {{ $request->input('selected_size') }}</p>
    </div>

    <!-- Buyer Information -->
    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg mb-10">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-4">Your Information</h2>
        <p class="text-lg text-gray-700 text-center mb-2"><strong>Name:</strong> {{ $request->input('first_name') }}</p>
        <p class="text-lg text-gray-700 text-center mb-2"><strong>Address:</strong> {{ $request->input('address') }}</p>
        <p class="text-lg text-gray-700 text-center mb-2"><strong>City:</strong> {{ $request->input('city') }}</p>
        <p class="text-lg text-gray-700 text-center"><strong>Phone:</strong> {{ $request->input('phone') }}</p>
    </div>

    <!-- Pay Button -->
    <button id="payButton" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg shadow-md text-lg font-medium focus:outline-none transition duration-300 mb-12">
        Pay Now
    </button>
</div>

<!-- Midtrans Snap Script -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    // Fungsi untuk melakukan pembayaran
    function initiatePayment() {
        snap.pay("{{ $snapToken }}", {
            onSuccess: function(result) {
                console.log('Payment Success:', result);
                // Handle successful payment
            },
            onPending: function(result) {
                console.log('Payment Pending:', result);
                // Handle pending payment
            },
            onError: function(result) {
                console.log('Payment Error:', result);
                // Handle payment error
            },
            onClose: function() {
                console.log('Payment Popup Closed');
                // Handle popup closed action
            }
        });
    }

    // Mengarahkan ke Midtrans setelah 5 detik
    setTimeout(function() {
        initiatePayment();
    }, 5000);

    // Event listener untuk tombol Pay Now
    document.getElementById('payButton').addEventListener('click', function() {
        initiatePayment();
    });
</script>
@endsection
