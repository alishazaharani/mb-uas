@extends('layouts.app')

@section('content')
<div class="container">
    <h2>{{ $category->name }}</h2>

    <div class="product-grid">
        @forelse ($products as $product)
            <div class="product-card">
                <img src="{{ asset('images/products/' . $product->image) }}">
                <h4>{{ $product->name }}</h4>
                <p>Rp {{ number_format($product->price) }}</p>
            </div>
        @empty
            <p>Belum ada produk di kategori ini.</p>
        @endforelse
    </div>
</div>
@endsection
