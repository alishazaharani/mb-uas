<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Admin Panel')</title>

    {{-- CSS ADMIN --}}
    <link rel="stylesheet" href="{{ asset('mitrabuana/homepage/css/admin-dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('mitrabuana/homepage/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('mitrabuana/homepage/css/index.css') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

<div class="admin-wrapper">
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar">
        <h2 class="brand">Mitra Buana</h2>

        <ul class="menu">
            <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}"><a href="{{ route('admin.products.index') }}">Produk</a></li>
            <li class="{{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
            <li class="{{ request()->routeIs('admin.pesanan.*') ? 'active' : '' }}"><a href="{{ route('admin.pesanan.index') }}">Pesanan</a></li>
            <li class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}"><a href="{{ route('admin.users.index') }}">User</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn">Logout</button>
                </form>
            </li>
        </ul>
    </aside>

    {{-- MAIN CONTENT --}}
    <main class="admin-content">
    @include('sweetalert::alert')
        @yield('content')
    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.all.min.js"></script>
</div>
</body>
</html>
