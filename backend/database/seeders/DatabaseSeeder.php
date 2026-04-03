<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(['email' => 'admin@email.com'], [
            'username' => 'admin',
            'name' => 'Admin',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        
        // User
        User::updateOrCreate(['email' => 'user@email.com'], [
            'username' => 'user',
            'name' => 'Khách Hàng',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Categories
        $cat1 = Category::updateOrCreate(['slug' => 'banh-kem'], ['name' => 'Bánh Kem']);
        $cat2 = Category::updateOrCreate(['slug' => 'banh-mi'], ['name' => 'Bánh Mì']);
        $cat3 = Category::updateOrCreate(['slug' => 'banh-ngot'], ['name' => 'Bánh Ngọt']);

        // Products
        Product::updateOrCreate(['slug' => 'banh-kem-dau-tay'], [
            'category_id' => $cat1->id,
            'name' => 'Bánh Kem Dâu Tây',
            'description' => 'Bánh kem tươi hương dâu ngọt ngào, mềm mịn.',
            'price' => 250000,
            'image' => 'https://images.unsplash.com/photo-1542826438-bd32f43d626f?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
        ]);

        Product::updateOrCreate(['slug' => 'banh-kem-socola'], [
            'category_id' => $cat1->id,
            'name' => 'Bánh Kem Socola',
            'description' => 'Bánh kem socola nguyên chất, đậm vị hấp dẫn.',
            'price' => 280000,
            'image' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
        ]);

        Product::updateOrCreate(['slug' => 'banh-mi-hoa-cuc'], [
            'category_id' => $cat2->id,
            'name' => 'Bánh Mì Hoa Cúc',
            'description' => 'Bánh mì Pháp trứ danh thơm mùi bơ hoa cúc.',
            'price' => 120000,
            'image' => 'https://images.unsplash.com/photo-1509440159596-0249088772ff?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
        ]);

        Product::updateOrCreate(['slug' => 'macaron-phap'], [
            'category_id' => $cat3->id,
            'name' => 'Macaron Pháp',
            'description' => 'Bánh macaron nhiều vị nhập khẩu thơm lừng.',
            'price' => 45000,
            'image' => 'https://images.unsplash.com/photo-1569864358642-9d1684040f43?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
        ]);
        
        Product::updateOrCreate(['slug' => 'banh-sanh-dieu'], [
            'category_id' => $cat3->id,
            'name' => 'Bánh Muffin Việt Quất',
            'description' => 'Muffin nướng tươi mỗi ngày, nhân việt quất.',
            'price' => 35000,
            'image' => 'https://images.unsplash.com/photo-1605116631885-ec7a3036fe16?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80'
        ]);
    }
}
