<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AdminKategoriController extends Controller
{
    public function index()
    {
        $data = Category::all();
        return view('admin.kategori.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try{
            $path = null;
            
            if ($request->hasFile('image')) {
                $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('ImageCategory', $originalName, 'public');
            }

            if($request->stock <= 5) {
                Alert::warning('Perhatian!', 'Stok hampir habis.');
            }

            Category::create([
                'name' => $request->name,
                'image' => $path,
            ]);

            Alert::success('Sukses', 'Kategori berhasil disimpan.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat menyimpan kategori.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try{

            $data = Category::findOrFail($id);
            $dataUpdate = $request->only(['name','image']);

            if ($request->hasFile('image')) {
                //delete last file
                if ($data->image && Storage::disk('public')->exists($data->image)) {
                    Storage::disk('public')->delete($data->image);
                }

                $originalName = time() . '_' . $request->file('image')->getClientOriginalName();
                $path = $request->file('image')->storeAs('ImageCategory', $originalName, 'public');
                $dataUpdate['image'] = $path;
            }

            $data->update($dataUpdate);

            Alert::success('Sukses', 'Kategori berhasil diperbarui.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat memperbarui kategori.' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try{
            $data = Category::withCount('products')->findOrFail($id);

            if ($data->products_count > 0) {
                Alert::warning(
                    'Gagal!',
                    'Kategori tidak bisa dihapus karena masih digunakan oleh produk.'
                );
                return redirect()->back();
            }

            //delete image file if exists
            if ($data->image && Storage::disk('public')->exists($data->image)) {
                Storage::disk('public')->delete($data->image);
            }

            $data->delete();

            Alert::success('Sukses', 'Kategori berhasil dihapus.');
            return redirect()->back();

        }catch(\Exception $e){
            Alert::error('Error', 'Terjadi kesalahan saat menghapus kategori.' . $e->getMessage());
            return redirect()->back();
        }
    }
}
