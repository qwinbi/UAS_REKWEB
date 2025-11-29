<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
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

        // Default settings
        Setting::create([
            'key' => 'about_content',
            'value' => '<div class="text-center">
                <img src="/storage/default-avatar.png" alt="Profile" class="rounded-circle mb-3" width="150" height="150">
                <h3>Nama Lengkap</h3>
                <p><strong>NIM:</strong> 123456789</p>
                <p><strong>Prodi:</strong> Teknik Informatika</p>
                <p><strong>Kelas:</strong> TI-01</p>
            </div>',
        ]);

        Setting::create([
            'key' => 'footer_content',
            'value' => 'BUNNYPOP - E-commerce Aesthetic © 2024. All rights reserved.',
        ]);

        // Create sample products
        \App\Models\Product::create([
            'name' => 'Bunny Plush Toy',
            'description' => 'Boneka kelinci yang lucu dan lembut, perfect untuk koleksi.',
            'price' => 89000,
            'stock' => 50,
            'category' => 'Toys',
            'image' => 'products/bunny-plush.jpg',
        ]);

        \App\Models\Product::create([
            'name' => 'Pink Aesthetic Notebook',
            'description' => 'Buku catatan aesthetic dengan tema pink dan bunny.',
            'price' => 35000,
            'stock' => 100,
            'category' => 'Stationery',
            'image' => 'products/notebook.jpg',
        ]);
    }
}