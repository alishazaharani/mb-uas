<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminUserController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'user')->get();
        return view('admin.user.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'password'   => 'required|min:8|confirmed',
            'company_id' => 'nullable|integer',
        ]);

        try {
            User::create([
                'name'       => $request->name,
                'email'      => $request->email,
                'password'   => Hash::make($request->password),
                'role'       => 'user',
                'company_id' => $request->company_id,
            ]);

            Alert::success('Sukses', 'User berhasil ditambahkan.');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menambahkan user. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email,' . $id,
            'password'   => 'nullable|min:8|confirmed',
            'company_id' => 'nullable|integer',
        ]);

        try {
            $user = User::findOrFail($id);
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->company_id = $request->company_id;
            $user->save();

            Alert::success('Sukses', 'User berhasil diperbarui.');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal memperbarui user. ' . $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            Alert::success('Sukses', 'User berhasil dihapus.');
            return redirect()->back();

        } catch (\Exception $e) {
            Alert::error('Error', 'Gagal menghapus user. ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
