<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Midtrans\Snap;

class PaymentController extends Controller
{
    public function showForm($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.buy', compact('product'));
    }

    public function processPayment(Request $request, $productId)
    {
        $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
        ]);

        $product = Product::findOrFail($productId);

        // Siapkan data untuk transaksi
        $orderData = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $product->price,
            ],
            'item_details' => [ // Tambahkan item_details untuk menyertakan informasi produk
                [
                    'id' => $product->id,
                    'price' => $product->price,
                    'quantity' => 1,
                    'name' => $request->input('product_name'), // Nama produk
                ],
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
            ],
        ];

        // Dapatkan token Snap dari Midtrans
        $snapToken = Snap::getSnapToken($orderData);

        // Kembalikan token, produk, dan data pembeli ke view
        return view('products.payment', compact('snapToken', 'product', 'request')); // Sertakan request
    }
}
