@extends('layouts.frontend')

@section('content')
<div class="container mt-4">
    <h3>Cart Saya</h3>

    <table class="table mt-3 table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
                $productIds = [];
            @endphp

            @foreach($carts as $cart)
                @php
                    $subtotal = $cart->product->price * $cart->qty;
                    $grandTotal += $subtotal;
                    $productIds[] = $cart->product_id;
                @endphp

                <tr>
                    <td>{{ $cart->product->name }}</td>
                    <td>
                        <form method="POST" action="{{ route('cart.update', $cart->id) }}">
                            @csrf
                            <input type="number" name="qty" value="{{ $cart->qty }}" min="1" class="form-control form-control-sm" onchange="this.form.submit()">
                        </form>
                    </td>
                    <td>Rp {{ number_format($cart->product->price) }}</td>
                    <td>Rp {{ number_format($subtotal) }}</td>
                </tr>
            @endforeach
        </tbody>

        @if($carts->count())
        <tfoot>
            <tr>
                <th colspan="3" class="text-end">Total Semua</th>
                <th>Rp {{ number_format($grandTotal) }}</th>
            </tr>
        </tfoot>
        @endif
    </table>

    {{-- Tombol Checkout Semua --}}
    @if($carts->count())
    <div class="text-end mt-3">
        <form action="{{ route('checkout.index') }}" method="GET">
            @csrf
            <input type="hidden" name="products" value="{{ implode(',', $productIds) }}">
            <button class="btn btn-success btn-lg">
                Checkout Semua
            </button>
        </form>
    </div>
    @endif
</div>
@endsection
