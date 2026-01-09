<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($id)
    {
        $category = Category::findOrFail($id);
        $products = $category->products;

        return view('category.show', compact('category', 'products'));
    }
}
