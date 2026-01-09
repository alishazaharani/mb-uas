<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderModel;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use DB;

class PesananController extends Controller
{
    public function index()
    {
        $data = OrderModel::all();
        return view('admin.pesanan.index', compact('data'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,cancelled,completed'
        ]);

        DB::beginTransaction();

        try {
            $order = OrderModel::with('product')->findOrFail($id);
            $product = $order->product;

            $oldStatus = $order->status;

            if ($request->status === 'completed' && $oldStatus !== 'completed') {

                if ($product->stock < $order->qty) {
                    Alert::error('Gagal', 'Stok produk tidak mencukupi');
                    return back();
                }

                $stokAwal = $product->stock;
                $stokAkhir = $stokAwal - $order->qty;

                // update stok
                $product->update([
                    'stock' => $stokAkhir
                ]);

                Alert::success(
                    'Berhasil',
                    "Pesanan diselesaikan. Stok {$stokAwal} → {$stokAkhir}"
                );
            } else {
                Alert::success('Berhasil', 'Status pesanan diperbarui');
            }

            $order->update([
                'status' => $request->status
            ]);

            DB::commit();
            return back();

        } catch (\Exception $e) {
            DB::rollBack();
            Alert::error('Error', $e->getMessage());
            return back();
        }
    }
}
