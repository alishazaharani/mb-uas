@extends('layouts.frontend')

@section('content')
<div class="container mt-4">
    <h3>Checkout Produk</h3>

    <form action="{{ route('checkout.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="product_id" value="{{ $product->id }}">

        <p><strong>{{ $product->name }}</strong></p>
        <p>Harga: Rp {{ number_format($product->price) }}</p>

        <div class="mb-3">
            <label>Qty</label>
            <input type="number" name="qty" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label>Metode Pembayaran</label>
            <select name="payment_method" class="form-control" required>
                <option value="transfer">Transfer Bank</option>
                <option value="cash">Cash</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Bukti Pembayaran</label>
            <input type="file" name="payment_proof" class="form-control">
        </div>

        <button class="btn btn-success">Checkout</button>
    </form>
</div>
@endsection
