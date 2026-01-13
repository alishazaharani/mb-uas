@extends('layouts.app')

@section('content')
<div class="container my-4">
    <h2 class="mb-4">{{ $category->name }}</h2>

    <div class="row">
        @forelse ($products as $product)
            <div class="col-md-3 mb-4">
                <div class="card h-100 shadow-sm">

                    <img 
                        src="{{ asset('storage/' . $product->image) }}" 
                        class="card-img-top"
                        style="height:180px; object-fit:contain;"
                        alt="{{ $product->name }}"
                    >

                    <div class="card-body text-center">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="fw-bold text-primary">
                            Rp {{ number_format($product->price) }}
                        </p>
                    </div>

                </div>
            </div>
        @empty
            <p>Belum ada produk di kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection
