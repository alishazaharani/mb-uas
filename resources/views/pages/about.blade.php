@extends('layouts.app')

@section('content')
<div class="container py-5">

    <!-- HERO -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Tentang Mitra Buana</h1>
        <p class="text-muted">Grosir modern dan tempat belanja lengkap untuk kebutuhan harian & usaha.</p>
    </div>

    {{-- FOTO BESAR (KAMU ISI SENDIRI) --}}
    <div class="text-center mb-4">
        <img src="{{ asset('images/about/foto1.jpg') }}" 
             alt="Mitra Buana Supermarket" class="img-fluid rounded d-block mx-auto">
    </div>

    <!-- PENJELASAN USAHA -->
    <div class="mb-5">
        <h4 class="fw-bold">Apa Itu Mitra Buana?</h4>
        <p>
            Mitra Buana adalah grosir pertama di Tasikmalaya yang memperkenalkan konsep modern
            dalam berbelanja kebutuhan harian dan kebutuhan usaha. Kami menyediakan produk lengkap
            dengan harga bersaing, pelayanan cepat, dan pengalaman berbelanja yang nyaman untuk
            semua pelanggan. Dari kebutuhan pribadi sampai ke warung, toko retail, maupun usaha kecil,
            Mitra Buana hadir menjadi solusi utama belanja Anda.
        </p>
    </div>

    <!-- VISI MISI -->
    <div class="row mb-5">
        <div class="col-md-6">
            <h5 class="fw-bold">Visi</h5>
            <p>
                Menjadi tempat grosir dan belanja kebutuhan harian dengan pengalaman terbaik,
                harga bersaing, dan pilihan lengkap untuk konsumen dan pelaku usaha.
            </p>
        </div>
        <div class="col-md-6">
            <h5 class="fw-bold">Misi</h5>
            <ul>
                <li>Menyediakan lebih dari ribuan item produk kebutuhan sehari-hari</li>
                <li>Memberikan harga terbaik dan kompetitif</li>
                <li>Memberikan pelayanan ramah, cepat, dan efisien</li>
                <li>Menciptakan lingkungan belanja yang nyaman dan tertata rapi</li>
            </ul>
        </div>
    </div>

    <!-- KEUNGGULAN -->
    <div class="mb-5">
        <h4 class="fw-bold text-center">Kenapa Memilih Mitra Buana?</h4>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/about/foto2.png') }}" alt="Produk Lengkap" class="mb-2 d-block mx-auto" style="width:60px;">
                <h6 class="fw-bold">Produk Lengkap</h6>
                <p class="text-muted">Lebih dari ribuan item tersedia untuk semua kebutuhan harian dan usaha.</p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/about/foto3.png') }}" alt="Harga Bersaing" class="mb-2 d-block mx-auto" style="width:60px;">
                <h6 class="fw-bold">Harga Bersaing</h6>
                <p class="text-muted">Harga satuan sampai harga borongan untuk usaha.</p>
            </div>
            <div class="col-md-4 mb-4">
                <img src="{{ asset('images/about/foto4.png') }}" alt="Pelayanan" class="mb-2 d-block mx-auto" style="width:60px;">
                <h6 class="fw-bold">Pelayanan Ramah</h6>
                <p class="text-muted">Layanan cepat, rapi, dan ramah untuk setiap konsumen.</p>
            </div>
        </div>
    </div>

    <!-- TESTIMONI SINGKAT -->
    <div class="mb-5">
        <h5 class="fw-bold text-center">Apa Kata Pelanggan?</h5>
        <p class="text-center text-muted fst-italic">
            “Mitra Buana tempat belanja favorit saya — lengkap, harga bersaing, pelayanannya ramah.”  
            — Pelanggan Setia Mitra Buana
        </p>
    </div>

    <!-- SOCIAL MEDIA -->
    <div class="text-center p-4 bg-light rounded">
        <h5 class="fw-bold">Ikuti Kami di Sosial Media</h5>
        <p>Kamu bisa mengikuti update promo, produk terbaru, dan info menarik lainnya!</p>
        {{-- LINK INSTAGRAM MITRA BUANA --}}
        <a href="https://www.instagram.com/mitrabuana.mb?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" class="btn btn-primary">
            <i class="bi bi-instagram"></i> Instagram Mitra Buana
        </a>
    </div>

</div>
@endsection
