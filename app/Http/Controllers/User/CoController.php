<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\OrderModel;
use App\Models\Product;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CoController extends Controller
{
    public function index(Request $request)
    {
        $product = Product::findOrFail($request->product);
        return view('pages.checkout', compact('product'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'     => 'required|exists:products,id',
            'qty'            => 'required|integer|min:1',
            'payment_method' => 'required|in:transfer,cash',
            'payment_proof'  => 'nullable|image|max:2048',
        ]);

        try {
            $product = Product::findOrFail($request->product_id);

            if ($request->qty > $product->stock) {
                Alert::warning('Gagal', 'Stok tidak mencukupi');
                return back();
            }

            $proofPath = null;
            if ($request->hasFile('payment_proof')) {
                $proofPath = $request->file('payment_proof')
                    ->store('payment_proof', 'public');
            }

            OrderModel::create([
                'user_id'        => auth()->id(),
                'product_id'     => $product->id,
                'qty'            => $request->qty,
                'price'          => $product->price,
                'total'          => $product->price * $request->qty,
                'payment_method'=> $request->payment_method,
                'payment_proof' => $proofPath,
                'status'         => 'pending',
            ]);

            Alert::success('Berhasil', 'Checkout berhasil, menunggu konfirmasi admin');
            return redirect()->route('checkout.history');

        } catch (\Exception $e) {
            Alert::error('Error', $e->getMessage());
            return back();
        }
    }

    public function history()
    {
        $orders = OrderModel::with('product')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $carts = CartModel::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('pages.history', compact('orders', 'carts'));
    }

    public function show($id)
{
    // Ambil kategori dan produk berdasarkan id kategori
    $category = Category::find($id);
    $products = Product::where('category_id', $id)->get(); // Ambil produk berdasarkan kategori

    return view('category.show', compact('category', 'products'));
}

}