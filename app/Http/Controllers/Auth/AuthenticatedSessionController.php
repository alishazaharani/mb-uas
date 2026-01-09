<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->validate([
            'login' => ['required', 'string'],
            'password' => ['required'],
        ]);

        $login = $request->login;
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'company_id';

        if (! Auth::attempt([
            $field => $login,
            'password' => $request->password,
        ], $request->boolean('remember'))) {

            Alert::error('Gagal', 'Email / ID atau password salah.');

            return back()->withErrors([
                'login' => 'Email / ID atau password salah.',
            ]);
        }

        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            Alert::success('Sukses', 'Anda berhasil login sebagai Admin.');
            return redirect()->route('home');
        }

        if ($user->role === 'superadmin') {
            Alert::success('Sukses', 'Anda berhasil login sebagai Super Admin.');
            return redirect()->route('home');
        }

        Alert::success('Sukses', 'Anda berhasil login.');
        return redirect()->intended(route('home'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
