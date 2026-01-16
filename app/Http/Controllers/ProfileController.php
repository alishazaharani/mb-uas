<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(): View
    {
        return view('profile.index');
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|min:6|confirmed',
        ]);

        $user = Auth::user();
        assert($user instanceof User);

        if (!$user) {
            return redirect('/login')->with('error', 'Silakan login terlebih dahulu');
        }

        $user->name = $request->name;
$user->email = $request->email;

if ($request->filled('password')) {
    $user->password = Hash::make($request->password);
}

$user->save();

        return back()->with('success', 'Profile berhasil diperbarui');
    }
}