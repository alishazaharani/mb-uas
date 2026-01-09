@extends('layouts.frontend')

@section('content')
<div class="container mt-4">
    <h3>Riwayat Pembelian</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Metode</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->product->name }}</td>
                <td>{{ $order->qty }}</td>
                <td>Rp {{ number_format($order->total) }}</td>
                <td>{{ ucfirst($order->payment_method ?? '-') }}</td>
                <td>
                    <span class="badge bg-warning">{{ $order->status }}</span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada transaksi</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <hr>

    <h3>Cart Saya</h3>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carts as $cart)
            <tr>
                <td>{{ $cart->product->name }}</td>
                <td>{{ $cart->qty }}</td>
                <td>Rp {{ number_format($cart->product->price * $cart->qty) }}</td>
                <td>
                    <div class="flex-row gap-2 d-flex">
                        <a href="{{ route('checkout.index', ['product' => $cart->product_id]) }}"
                        class="btn btn-sm btn-success">Checkout</a>
                        
                        <form method="POST" action="{{ route('cart.delete', $cart->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
