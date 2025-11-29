<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Setting;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Nonaktifkan foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        // Clear existing data dengan cara yang aman
        User::query()->delete();
        Setting::query()->delete();
        Product::query()->delete();
        Cart::query()->delete();
        Order::query()->delete();
        Payment::query()->delete();

        // Aktifkan kembali foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Reset auto increment
        DB::statement('ALTER TABLE users AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE settings AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE carts AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE orders AUTO_INCREMENT = 1');
        DB::statement('ALTER TABLE payments AUTO_INCREMENT = 1');

        // Create admin user
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('1234'),
            'role' => 'admin',
        ]);

        // Create guest user
        User::create([
            'name' => 'Guest User',
            'email' => 'guest@email.com',
            'password' => Hash::make('4321'),
            'role' => 'guest',
        ]);

        // Default settings - UPDATE INI
        Setting::create([
            'key' => 'about_content',
            'value' => '<div class="row">
    <div class="col-md-4 text-center">
        <div class="mb-4">
            <div class="bg-light rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3" style="width: 200px; height: 200px;">
                <i class="fas fa-user fa-3x text-muted"></i>
            </div>
            <h4>Syarifatul Azkiya Alganjari</h4>
            <p class="mb-1"><strong>NIM:</strong> 241011701321</p>
            <p class="mb-1"><strong>Prodi:</strong> Sistem Informasi</p>
            <p class="mb-0"><strong>Kelas:</strong> 03SIFP014</p>
        </div>
    </div>
    <div class="col-md-8">
        <h4 style="color: #ECCACB;">🎀 Tentang BUNNYPOP</h4>
        <p><strong>BUNNYPOP</strong> adalah platform e-commerce aesthetic yang dibangun dengan Laravel framework sebagai project UAS Pemrograman Web Framework.</p>
        
        <h5 style="color: #ECCACB;">🛠️ Teknologi yang Digunakan</h5>
        <ul>
            <li>Laravel 10</li>
            <li>Bootstrap 5</li>
            <li>MySQL</li>
            <li>Font Awesome Icons</li>
            <li>Blade Templating</li>
        </ul>
        
        <h5 style="color: #ECCACB;">🎯 Fitur Utama</h5>
        <ul>
            <li>Dual Role System (Admin & Guest)</li>
            <li>CRUD Products Management</li>
            <li>Shopping Cart & Checkout System</li>
            <li>Payment System dengan bukti transfer</li>
            <li>Dynamic Content Management</li>
            <li>Photo Upload untuk About Page</li>
            <li>Responsive Mobile-Friendly Design</li>
        </ul>

        <h5 style="color: #ECCACB;">👤 Demo Accounts</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Admin Account</h6>
                        <p class="mb-1"><strong>Email:</strong> admin@email.com</p>
                        <p class="mb-0"><strong>Password:</strong> 1234</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-body">
                        <h6 class="card-title">Guest Account</h6>
                        <p class="mb-1"><strong>Email:</strong> guest@email.com</p>
                        <p class="mb-0"><strong>Password:</strong> 4321</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>',
        ]);

        Setting::create([
            'key' => 'footer_content',
            'value' => 'BUNNYPOP - E-commerce Aesthetic © 2024. All rights reserved.',
        ]);

        // TAMBAHKAN INI - Setting untuk about_photo
        Setting::create([
            'key' => 'about_photo',
            'value' => '', // Kosongkan awalnya
        ]);

        // Create sample products
        Product::create([
            'name' => 'Bunny Plush Toy',
            'description' => 'Boneka kelinci yang lucu dan lembut, perfect untuk koleksi.',
            'price' => 89000,
            'stock' => 50,
            'category' => 'Toys',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Pink Aesthetic Notebook',
            'description' => 'Buku catatan aesthetic dengan tema pink dan bunny.',
            'price' => 35000,
            'stock' => 100,
            'category' => 'Stationery',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Cute Bunny Stickers',
            'description' => 'Set stiker kelinci lucu untuk decorasi notebook dan laptop.',
            'price' => 15000,
            'stock' => 200,
            'category' => 'Stationery',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Bunny Ears Headband',
            'description' => 'Headband telinga kelinci yang imut untuk fashion sehari-hari.',
            'price' => 45000,
            'stock' => 30,
            'category' => 'Fashion',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Aesthetic Pink Keyboard',
            'description' => 'Keyboard mechanical aesthetic dengan tema pink pastel.',
            'price' => 250000,
            'stock' => 15,
            'category' => 'Electronics',
            'image' => null,
        ]);

        Product::create([
            'name' => 'Bunny Phone Case',
            'description' => 'Case handphone motif kelinci lucu untuk berbagai tipe smartphone.',
            'price' => 65000,
            'stock' => 75,
            'category' => 'Electronics',
            'image' => null,
        ]);

        $this->command->info('🎉 Demo data created successfully!');
        $this->command->info('🔐 Admin Account: admin@email.com / 1234');
        $this->command->info('👤 Guest Account: guest@email.com / 4321');
        $this->command->info('📸 About Photo: Bisa diupload melalui admin panel');
        $this->command->info('🛍️ Products: ' . Product::count() . ' sample products created');
    }
}