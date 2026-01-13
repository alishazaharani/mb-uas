<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>MitraBuana.id</title>

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('mitrabuana/homepage/css/home.css') }}">
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- CONTENT --}}
    <main class="container px-2">
        @include('sweetalert::alert')
        @yield('content')
    </main>
    {{-- FOOTER --}}
    @include('partials.footer')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.9/dist/sweetalert2.all.min.js"></script>
</body>
</html> 
