@extends('layouts.frontend')

@section('content')
    {{-- HERO / BANNER --}}
    <section class="home-hero">
        <img src="{{ asset('mitrabuana/homepage/images/banner.png') }}" alt="Mitra Buana Banner">
    </section>

    {{-- KATEGORI PILIHAN --}}
    <section class="container">
        <div class="category-wrapper">
            <h2 class="section-title">Kategori Pilihan</h2>

            <div class="category-grid">
                @foreach ($categories as $category)
                    <a href="{{ route('category.show', $category->id) }}" class="category-card">
                        {{-- Pastikan semua gambar kategori ada di public/mitrabuana/categories --}}
                        <img src="{{ $category->image ? asset('mitrabuana/categories/' . $category->image) : asset('mitrabuana/images/no-image.png') }}" alt="{{ $category->name }}">
                        <p>{{ $category->name }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- PRODUK PILIHAN / FOR YOU --}}
    <section class="container">
        <h2 class="section-title">Untuk Kamu</h2>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        {{-- Pastikan semua gambar produk ada di public/mitrabuana/products --}}
                        <img src="{{ $product->image ? asset('mitrabuana/products/' . $product->image) : asset('mitrabuana/images/no-image.png') }}" alt="{{ $product->name }}">
                    </div>

                    <div class="product-info">
                        <p class="product-name">{{ $product->name }}</p>
                        <p class="product-price">Rp {{ number_format($product->price) }}</p>
                        <button type="button"
                                class="mt-2 btn btn-sm btn-primary w-100 btn-checkout"
                                data-product="{{ $product->id }}">
                            Checkout
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- SECTION PER KATEGORI (STYLE BIRU) --}}
    @foreach ($previewCategories as $category)
        <section class="category-preview-wrapper">
            <h2 class="category-preview-title">{{ $category->name }}</h2>

            <div class="category-preview-list">
                @forelse($category->products as $product)
                    <div class="product-preview-card">
                        <div class="product-image">
                            <img src="{{ $product->image ? asset('mitrabuana/products/' . $product->image) : asset('mitrabuana/images/no-image.png') }}" alt="{{ $product->name }}">
                        </div>
                        
                        <div class="product-info">
                            <p class="product-name">{{ $product->name }}</p>
                            <p class="product-price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-white">Belum ada produk</p>
                @endforelse
            </div>
        </section>
    @endforeach

    {{-- MODAL CHECKOUT --}}
    <div class="modal fade" id="checkoutModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Aksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="text-center modal-body">
                    <p class="mb-4">Produk akan diproses, pilih aksi:</p>

                    <div class="gap-2 d-grid">
                        <a href="#" id="btnAddToCart" class="btn btn-secondary">Masukkan ke Cart</a>
                        <a href="#" id="btnCheckoutNow" class="btn btn-primary">Checkout Sekarang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- SCRIPT CHECKOUT MODAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const modal = new bootstrap.Modal(document.getElementById('checkoutModal'));
            let selectedProduct = null;

            document.querySelectorAll('.btn-checkout').forEach(btn => {
                btn.addEventListener('click', function () {
                    selectedProduct = this.dataset.product;

                    document.getElementById('btnCheckoutNow').href =
                        `{{ route('checkout.index') }}?product=${selectedProduct}`;

                    document.getElementById('btnAddToCart').href =
                        `{{ route('cart.index') }}?product=${selectedProduct}`;

                    modal.show();
                });
            });
        });
    </script>
@endsection
