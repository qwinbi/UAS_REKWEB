<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja kosong!');
        }
        
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        
        return view('payment.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:virtual_account,qris',
            'proof_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => $total,
            'status' => 'pending',
        ]);

        // Create payment
        $proofPath = $request->file('proof_image')->store('payments', 'public');
        
        Payment::create([
            'order_id' => $order->id,
            'method' => $request->payment_method,
            'proof_image' => $proofPath,
            'status' => 'pending',
        ]);

        // Clear cart
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('home')->with('success', 'Pembayaran berhasil dikirim! Menunggu verifikasi admin.');
    }
}