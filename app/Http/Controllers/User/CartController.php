<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('product')) {
            $cart = CartModel::where('user_id', auth()->id())
                ->where('product_id', $request->product)
                ->first();

            if ($cart) {
                $cart->increment('qty', 1);
            } else {
                CartModel::create([
                    'user_id' => auth()->id(),
                    'product_id' => $request->product,
                    'qty' => 1
                ]);
            }

            Alert::success('Berhasil', 'Produk ditambahkan ke cart');
            return redirect()->route('cart.index');
        }
        
        $carts = CartModel::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('pages.cart', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1'
        ]);

        $cart = CartModel::where('user_id', auth()->id())
            ->where('product_id', $request->product_id)
            ->first();

        if ($cart) {
            $cart->increment('qty', $request->qty);
        } else {
            CartModel::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'qty' => $request->qty
            ]);
        }

        Alert::success('Berhasil', 'Produk ditambahkan ke cart');
        return redirect()->route('cart.index');
    }

    public function update(Request $request, $id)
    {
        $cart = CartModel::where('user_id', auth()->id())
            ->where('id', $id)
            ->firstOrFail();

        $cart->update([
            'qty' => $request->qty
        ]);

        Alert::success('Berhasil', 'Qty diperbarui');
        return back();
    }

    public function destroy($id)
    {
        CartModel::where('user_id', auth()->id())
            ->where('id', $id)
            ->delete();

        Alert::success('Dihapus', 'Produk dihapus dari cart');
        return back();
    }
}
