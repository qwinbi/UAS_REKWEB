<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Payment;
use App\Models\Setting;
use App\Models\Order;
use App\Models\User;
use App\Models\Cart;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $pendingPayments = Payment::where('status', 'pending')->count();
        $totalUsers = User::count();
        
        return view('admin.dashboard', compact('totalProducts', 'totalOrders', 'pendingPayments', 'totalUsers'));
    }

    public function products()
    {
        $products = Product::latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('admin.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('image')->store('products', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['name', 'description', 'price', 'stock', 'category']);
        
        if ($request->hasFile('image')) {
            // Delete old image
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('admin.products')->with('success', 'Produk berhasil dihapus!');
    }

    public function payments()
    {
        $payments = Payment::with('order.user')->latest()->get();
        return view('admin.payments.index', compact('payments'));
    }

    public function updatePaymentStatus(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update(['status' => $request->status]);
        
        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui!');
    }

    public function about()
    {
        $about = Setting::getValue('about_content', '');
        $about_photo = Setting::getValue('about_photo', '');
        return view('admin.about', compact('about', 'about_photo'));
    }

    public function updateAbout(Request $request)
    {
        $request->validate([
            'about_content' => 'required|string',
            'about_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        Setting::setValue('about_content', $request->about_content);

        // Handle photo upload
        if ($request->hasFile('about_photo')) {
            // Delete old photo if exists
            $currentPhoto = Setting::getValue('about_photo');
            if ($currentPhoto) {
                Storage::disk('public')->delete($currentPhoto);
            }
            
            $photoPath = $request->file('about_photo')->store('about', 'public');
            Setting::setValue('about_photo', $photoPath);
        }

        return redirect()->route('admin.about')->with('success', 'Halaman About berhasil diperbarui!');
    }

    public function removeAboutPhoto()
    {
        $currentPhoto = Setting::getValue('about_photo');
        if ($currentPhoto) {
            Storage::disk('public')->delete($currentPhoto);
        }
        Setting::setValue('about_photo', '');

        return redirect()->route('admin.about')->with('success', 'Foto About berhasil dihapus!');
    }

    public function footer()
    {
        $footer = Setting::getValue('footer_content', '');
        return view('admin.footer', compact('footer'));
    }

    public function updateFooter(Request $request)
    {
        Setting::setValue('footer_content', $request->footer_content);
        return redirect()->route('admin.footer')->with('success', 'Footer berhasil diperbarui!');
    }

    public function logo()
    {
        $logo = Setting::getValue('logo_path', '');
        return view('admin.logo', compact('logo'));
    }

    public function updateLogo(Request $request)
    {
        $request->validate([
            'logo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $logoPath = $request->file('logo')->store('logos', 'public');
        Setting::setValue('logo_path', $logoPath);

        return redirect()->route('admin.logo')->with('success', 'Logo berhasil diperbarui!');
    }
}