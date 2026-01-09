<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $dataUser = User::count();
        $dataProduct = Product::count();
        return view('superadmin.dashboard', compact('dataUser', 'dataProduct'));
    }
}
