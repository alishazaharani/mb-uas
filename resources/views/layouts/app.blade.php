<!DOCTYPE html> 
<html> 
    <head> 
        <meta charset="utf-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1"> 
        <meta name="csrf-token" content="{{ csrf_token() }}"> 

        <!-- TITLE TAB -->
        <title>Mitra Buana</title>

        <!-- FAVICON / LOGO TAB -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts --> 
        <link rel="preconnect" href="https://fonts.bunny.net"> 
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> 

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('mitrabuana/superadmin/css/superadmin.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
              integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
              crossorigin="anonymous">

        <!-- SweetAlert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <!-- Scripts --> 
        @vite(['resources/css/app.css', 'resources/js/app.js']) 
    </head>

    <style>
        .stat-box {
            border-radius: 8px;
            padding: 20px;
            color: #fff;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0,0,0,.1);
        }

        .stat-box h6 {
            font-size: 13px;
            text-transform: uppercase;
            opacity: 0.9;
        }

        .stat-box h4 {
            font-weight: bold;
            margin-top: 10px;
        }

        .bg-blue {
            background: linear-gradient(45deg, #4e73df, #224abe);
        }

        .bg-green {
            background: linear-gradient(45deg, #1cc88a, #13855c);
        }

        .bg-orange {
            background: linear-gradient(45deg, #f6c23e, #dda20a);
        }

        .bg-purple {
            background: linear-gradient(45deg, #6f42c1, #4e2a8e);
        }
        .active-quick {
            border: 2px solid #4e73df;
            background-color: #f0f4ff;
        }

    </style>
<body class="bg-light">

    @include('layouts.navigation')

    @auth
    @if(auth()->user()->role === 'superadmin')
    <div class="container mt-4">
        <div class="shadow-sm card">
            <div class="card-body">
                <h5 class="mb-3 font-weight-bold">Quick Access</h5>

                <div class="flex-row text-center d-flex ">
                    <div class="mb-3 col-6 col-md-3">
                        <a href="#" class="p-3 shadow-sm card text-decoration-none">
                            <div class="fs-3">📦</div>
                            <small>Kelola Produk</small>
                        </a>
                    </div>

                    <div class="mb-3 col-6 col-md-3">
                        <a href="{{ route('superadmin.users.index') }}" class="p-3 shadow-sm card text-decoration-none {{ request()->routeIs('superadmin.users.*') ? 'active-quick' : '' }}">
                            <div class="fs-3">👥</div>
                            <small>User & Role</small>
                        </a>
                    </div>

                    <div class="mb-3 col-6 col-md-3">
                        <a href="#" class="p-3 shadow-sm card text-decoration-none">
                            <div class="fs-3">🕒</div>
                            <small>Absensi</small>
                        </a>
                    </div>

                    <div class="mb-3 col-6 col-md-3">
                        <a href="#" class="p-3 shadow-sm card text-decoration-none">
                            <div class="fs-3">📊</div>
                            <small>Laporan</small>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
 @endif
@endauth

    {{-- PAGE CONTENT --}}
    <main class="container py-4 ">
        @include('sweetalert::alert')
        @yield('content')
    </main>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.all.min.js"></script>
</body>
</html>
