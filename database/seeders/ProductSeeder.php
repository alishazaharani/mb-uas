<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $category = Category::first();

        if (!$category) {
            return;
        }

        $products = [
            [
                'name' => 'Smartphone X',
                'price' => 3500000,
                'description' => 'Smartphone dengan performa tinggi dan kamera jernih.',
                'image' => 'products/sample.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Headphone Wireless',
                'price' => 750000,
                'description' => 'Headphone nyaman dengan kualitas suara premium.',
                'image' => 'products/sample.jpg',
                'category_id' => $category->id
            ],
            [
                'name' => 'Sepatu Sneakers',
                'price' => 550000,
                'description' => 'Sneakers stylish cocok untuk aktivitas harian.',
                'image' => 'products/sample.jpg',
                'category_id' => $category->id
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
