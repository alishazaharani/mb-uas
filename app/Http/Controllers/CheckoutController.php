<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CartModel;

class CheckoutController extends Controller
{
    public function checkoutAll()
    {
        // pastikan user login
        if (!Auth::check()) {
            return redirect('/login');
        }

        // ambil semua cart user
        $cartItems = CartModel::with('product')
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Cart kamu masih kosong');
        }

        // kirim ke halaman checkout
        return view('checkout.index', compact('cartItems'));
    }
}
