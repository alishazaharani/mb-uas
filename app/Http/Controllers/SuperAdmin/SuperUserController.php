<?php

namespace App\Http\Controllers\SuperAdmin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class SuperUserController extends Controller
{
    public function index()
    {
        $dataUser = User::where('role','user')->get();
        $dataAdmin = User::where('role','admin')->get();

        return view('superadmin.users.index', compact('dataUser', 'dataAdmin'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:user,admin',
        ]);

        try {
            User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => $request->role,
                'company_id' => null,
            ]);

            Alert::success('Berhasil', 'User berhasil ditambahkan');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: '.$e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,'.$id,
            'role'  => 'sometimes|in:user,admin',
        ]);

        try {
            $user = User::findOrFail($id);

            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
                'role'  => $request->role,
            ]);

            Alert::success('Berhasil', 'User berhasil diupdate');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan: '.$e->getMessage());
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();

            Alert::success('Berhasil', 'User berhasil dihapus');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Gagal', 'Gagal menghapus user');
            return redirect()->back();
        }
    }
}
