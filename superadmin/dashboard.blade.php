@extends('layouts.app')

@section('content')
<h3 class="mb-4 font-weight-bold">Dashboard SuperAdmin</h3>

<div class="row">

    <div class="mb-4 col-md-3">
        <div class="border-0 shadow-sm card">
            <div class="text-center text-white card-body bg-primary">
                <h6>Pendapatan Hari Ini</h6>
                <h4>Rp {{ number_format($todayRevenue ?? 0) }}</h4>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-3">
        <div class="border-0 shadow-sm card">
            <div class="text-center text-white card-body bg-success">
                <h6>Pendapatan Bulanan</h6>
                <h4>Rp {{ number_format($monthlyRevenue ?? 0) }}</h4>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-3">
        <div class="border-0 shadow-sm card">
            <div class="text-center text-white card-body bg-warning">
                <h6>Total User</h6>
                <h4>{{ $dataUser }}</h4>
            </div>
        </div>
    </div>

    <div class="mb-4 col-md-3">
        <div class="border-0 shadow-sm card">
            <div class="text-center text-white card-body bg-info">
                <h6>Total Produk</h6>
                <h4>{{ $dataProduct }}</h4>
            </div>
        </div>
    </div>

</div>
@endsection
