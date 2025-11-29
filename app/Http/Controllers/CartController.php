<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();
        
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        $totalItems = $cartItems->sum('quantity');
        
        return view('cart.index', compact('cartItems', 'subtotal', 'totalItems'));
    }

    public function add(Request $request, $productId)
    {
        // Check if user is guest (not admin)
        if (auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Admin cannot add items to cart.');
        }

        $product = Product::findOrFail($productId);
        
        // Check stock availability
        if ($product->stock < 1) {
            return redirect()->back()->with('error', 'Produk sedang tidak tersedia!');
        }

        $cartItem = Cart::where('user_id', auth()->id())
                       ->where('product_id', $productId)
                       ->first();
        
        if ($cartItem) {
            // Check if adding more exceeds stock
            if (($cartItem->quantity + 1) > $product->stock) {
                return redirect()->back()->with('error', 'Stok produk tidak mencukupi!');
            }
            $cartItem->increment('quantity');
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $productId,
                'quantity' => 1,
            ]);
        }
        
        return redirect()->back()->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $cartId)
    {
        // Check if user is guest (not admin)
        if (auth()->user()->isAdmin()) {
            return redirect()->route('products.index')->with('error', 'Admin cannot update cart.');
        }

        $cart = Cart::with('product')->findOrFail($cartId);
        
        // Check if cart belongs to current user
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Check stock availability
        if ($request->quantity > $cart->product->stock) {
            return redirect()->back()->with('error', 'Stok produk tidak mencukupi! Stok tersedia: ' . $cart->product->stock);
        }

        $cart->update(['quantity' => $request->quantity]);
        
        return redirect()->back()->with('success', 'Keranjang berhasil diperbarui!');
    }

    public function remove($cartId)
    {
        $cart = Cart::findOrFail($cartId);
        
        // Check if cart belongs to current user (baik admin maupun guest)
        if ($cart->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Akses ditolak!');
        }

        $cart->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }

    public function clear()
    {
        Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('cart.index')->with('success', 'Keranjang berhasil dikosongkan!');
    }

    // Method baru untuk admin menghapus cart user lain (optional)
    public function adminRemove($cartId)
    {
        // Hanya admin yang bisa akses ini
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Akses ditolak! Hanya admin yang bisa menghapus cart user lain.');
        }

        $cart = Cart::findOrFail($cartId);
        $userName = $cart->user->name;
        $cart->delete();

        return redirect()->back()->with('success', "Cart item dari user {$userName} berhasil dihapus!");
    }

    public function adminClearUserCart($userId)
    {
        // Hanya admin yang bisa akses ini
        if (!auth()->user()->isAdmin()) {
            return redirect()->back()->with('error', 'Akses ditolak! Hanya admin yang bisa mengosongkan cart user lain.');
        }

        $user = \App\Models\User::findOrFail($userId);
        Cart::where('user_id', $userId)->delete();

        return redirect()->back()->with('success', "Cart user {$user->name} berhasil dikosongkan!");
    }
}