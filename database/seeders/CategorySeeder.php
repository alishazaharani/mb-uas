<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik'],
            ['name' => 'Fashion'],
            ['name' => 'Kecantikan'],
            ['name' => 'Rumah Tangga'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
