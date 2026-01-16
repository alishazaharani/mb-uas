@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3>Checkout Semua</h3>

    <table class="table">
        <thead>
            <tr>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php $grandTotal = 0; @endphp

            @foreach($cartItems as $item)
                @php
                    $total = $item->qty * $item->product->price;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td>{{ $item->product->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>Rp {{ number_format($item->product->price) }}</td>
                    <td>Rp {{ number_format($total) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total Semua: Rp {{ number_format($grandTotal) }}</h4>
</div>
@endsection
