<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $category = Category::all();
        return view('admin.products.index', compact('products', 'category'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'kategori_id' => 'required|exists:categories,id',
        ]);

        if ($request->stock < 10) {
            Alert::warning('Gagal!', 'Stok tidak boleh kurang dari 10.');
            return redirect()->back()->withInput(); 
        }

        try{
            $path = null;
            
            if ($request->hasFile('image')) {
                $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('ImageProduct', $originalName, 'public');
            }

            if($request->stock <= 5) {
                Alert::warning('Perhatian!', 'Stok hampir habis.');
            }

            Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $path,
                'description' => $request->description,
                'stock' => $request->stock,
                'kategori_id' => $request->kategori_id,
            ]);

            Alert::success('Sukses', 'Produk berhasil disimpan.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan produk.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'nullable|string',
            'stock' => 'sometimes|integer',
            'kategori_id' => 'sometimes|exists:categories,id',
        ]);

        try{

            $data = Product::findOrFail($id);
            $dataUpdate = $request->only(['name', 'price', 'description', 'image', 'stock', 'kategori_id']);

            if ($request->filled('stock') && $request->stock < 10) {
                Alert::warning('Gagal!', 'Stok tidak boleh kurang dari 10.');
                return redirect()->back()->withInput();
            }

            if ($request->hasFile('image')) {
                //delete last file
                if ($data->image && Storage::disk('public')->exists($data->image)) {
                    Storage::disk('public')->delete($data->image);
                }

                $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('ImageProduct', $originalName, 'public');
                $dataUpdate['image'] = $path;
            }

            $data->update($dataUpdate);

            Alert::success('Sukses', 'Produk berhasil diperbarui.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui produk.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $data = Product::findOrFail($id);

            //delete image file if exists
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $data->delete();

            Alert::success('Sukses', 'Produk berhasil dihapus.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat menghapus produk.' . $e->getMessage());
            return redirect()->back();
        }
    }
}
