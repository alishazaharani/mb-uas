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
                <th>Ket</th>
            </tr>
        </thead>
        <tbody>
            @forelse($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>
                    <form method="POST" action="{{ route('cart.update', $cart->id) }}">
                        @csrf
                        <input type="number" name="qty" value="{{ $cart->qty }}" min="1"
                            class="form-control form-control-sm"
                            onchange="this.form.submit()">
                    </form>
                </td>
                <td>Rp {{ number_format($cart->product->price) }}</td>
                <td>Rp {{ number_format($cart->product->price * $cart->qty) }}</td>
                <td class="gap-1 d-flex">
                    data otomatis tertambah di halaman history pada icon keranjang
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Cart kosong</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
