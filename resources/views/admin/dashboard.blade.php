@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
    <header class="admin-header">
        <h1>Dashboard Admin</h1>
        <p>Selamat datang, Admin 👋</p>
    </header>

    <section class="admin-cards">
        <div class="card">
            <h3>Total Produk</h3>
            <p>{{ $totalProduk ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Total Kategori</h3>
            <p>{{ $totalKategori ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Total User</h3>
            <p>{{ $totalUser ?? 0 }}</p>
        </div>

        <div class="card">
            <h3>Pesanan Hari Ini</h3>
            <p>—</p>
        </div>
    </section>

@endsection