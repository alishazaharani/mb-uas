@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row g-4">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    style="width:100%; height:360px; object-fit:contain;"
                >
            </div>
        </div>

        <div class="col-md-7">
            <h2 class="mb-2">{{ $product->name }}</h2>
            <h4 class="text-primary fw-bold mb-3">Rp {{ number_format($product->price) }}</h4>

            <div class="mb-3">
                <h6 class="fw-bold">Deskripsi</h6>
                <p class="text-muted">
                    {{ $product->description ?? 'Deskripsi belum tersedia.' }}
                </p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">Kembali</a>
                {{-- nanti bisa tambah tombol keranjang --}}
                <button class="btn btn-primary" disabled>Tambah ke Keranjang</button>
            </div>
        </div>
    </div>
</div>
@endsection
