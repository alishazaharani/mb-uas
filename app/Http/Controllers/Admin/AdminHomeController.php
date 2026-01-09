<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function index()
    {
        $totalProduk   = Product::count();
        $totalKategori = Category::count();
        $totalUser     = User::count();
        return view('admin.dashboard', compact('totalProduk', 'totalKategori', 'totalUser'));
    }
}
