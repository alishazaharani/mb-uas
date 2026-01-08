<nav class="navbar-mb">
    {{-- LEFT --}}
    <div class="navbar-left">
        <img src="{{ asset('mitrabuana/logo/logo.png') }}" alt="Mitra Buana" class="logo">
        <a href="#" class="nav-link">Kategori</a>
    </div>

    {{-- SEARCH + CART (1 baris) --}}
    <div class="navbar-search">
        <form action="{{ route('search') }}" method="GET" class="search-form">
            <span class="search-icon">🔍</span>
            <input type="text" name="q" placeholder="Cari di Mitra Buana" value="{{ request('q') }}">
        </form>

        <a href="{{ route('checkout.history') }}" class="cart-icon" aria-label="Keranjang">🛒</a>
    </div>

    {{-- RIGHT --}}
    <div class="navbar-right">
        <a href="#" class="nav-link">About</a>

        @guest
            <a href="{{ route('login') }}" class="btn-outline">Masuk</a>
            <a href="{{ route('register') }}" class="btn-primary">Daftar</a>
        @else
            <div class="nav-user" id="navUser">
                <button type="button" class="dropdown-toggle" id="userDropdownBtn" aria-haspopup="true" aria-expanded="false">
                    Halo, {{ Auth::user()->name }} <span class="arrow">▾</span>
                </button>

                <div class="dropdown-menu" id="userDropdownMenu" role="menu">
                    <a href="{{ route('home') }}">Dashboard</a>
                    <a href="{{ route('profile.edit') }}">Profile</a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}">Dashboard Admin</a>
                    @endif

                    @if(auth()->user()->role === 'superadmin')
                        <a href="{{ route('superadmin.dashboard') }}">Dashboard Super Admin</a>
                    @endif

        
                    <hr>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            </div>
        @endguest
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const wrapper = document.getElementById('navUser');
    const btn = document.getElementById('userDropdownBtn');
    const menu = document.getElementById('userDropdownMenu');

    if (!wrapper || !btn || !menu) return;

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = wrapper.classList.toggle('open');
        btn.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    document.addEventListener('click', () => {
        wrapper.classList.remove('open');
        btn.setAttribute('aria-expanded', 'false');
    });
    });
</script>
