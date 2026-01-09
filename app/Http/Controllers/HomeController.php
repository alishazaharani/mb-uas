<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // kategori pilihan untuk preview biru
        $previewCategories = Category::with(['products' => function ($query) {
            $query->latest()->take(6);
        }])
        ->whereIn('name', ['sembako', 'kecantikan'])
        ->get();

        $categories = Category::all();

        $products = Product::when($request->q, function ($query) use ($request) {
            $query->where('name', 'like', '%'.$request->q.'%');
        })
        ->latest()
        ->take(8)
        ->get();

        return view('pages.home', compact(
            'categories',
            'products',
            'previewCategories'
        ));
    }

}
