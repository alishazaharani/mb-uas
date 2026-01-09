<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class KaryawanController extends Controller
{
    /**
     * Dashboard karyawan
     */
    public function dashboard()
    {
        return view('karyawan.dashboard');
    }

    /**
     * Data karyawan (untuk superadmin nanti)
     */
    public function index()
    {
        $karyawans = User::where('role', 'karyawan')->get();
        return view('karyawan.dashboard', compact('karyawans'));
    }
}
