<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//        DB::table('users')->insert([
//            'name' => 'Admin 1',
//            'email' => 'admin1@gmail.com',
//            'phone' => '92929282828',
//            'address' => 'A17',
//            'DOB' => '1990-05-15',
//            'role' => 'admin',
//            'password' => Hash::make('123'),
//        ]);
//        DB::table('users')->insert([
//            'name' => 'Customer ',
//            'email' => 'customer1@gmail.com',
//            'phone' => '92929282829',
//            'address' => 'A17',
//            'DOB' => '1990-05-15',
//            'role' => 'customer',
//            'password' => Hash::make('123'),
////        ]);
        DB::table('products')->insert([
            [
                'id' => 1,
                'isbn_code' => '123456789',
                'name' => 'Product A',
                'price' => 99.99,
                'quantity' => 50,
                'description' => 'Description for Product A',
                'image' => 'product_a.jpg',
                'category_id' => 1,
                'brand_id' => 1,
            ],
            [
                'id' => 2,
                'isbn_code' => '987654321',
                'name' => 'Product B',
                'price' => 149.99,
                'quantity' => 30,
                'description' => 'Description for Product B',
                'image' => 'product_b.jpg',
                'category_id' => 2,
                'brand_id' => 2,
            ],

//
//            DB::table('brands')->insert([
//                [
//                    'id' => 1,
//                    'name' => 'Acer'
//                ],
//                [
//                    'id' => 2,
//                    'name' => 'Gigabyte',
//                ],
            // Thêm các bản ghi khác tương tự ở đây
        ]);
    }
}
