<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-custom fixed-top">
    <div class="container">
        <a class="navbar-brand-custom" href="{{ url('/beranda') }}">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Prabhakala" onerror="this.style.display='none'">
            <span class="navbar-brand-text">PRABHAKALA E-BOOKING</span>
        </a>

        <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('beranda') ? 'active' : '' }}"
                        href="{{ url('/beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('booking') ? 'active' : '' }}"
                        href="{{ url('/booking') }}">Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('informasi-booking') ? 'active' : '' }}"
                        href="{{ route('booking.info') }}">Informasi Booking</a>
                </li>
                @guest
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('login') ? 'active' : '' }}"
                            href="{{ url('/login') }}">Login</a>
                    </li>
                @else
                    <li class="nav-item dropdown">
                        <button class="btn btn-light dropdown-toggle mt-1 mt-lg-0 ms-lg-2" type="button"
                            id="navbarUserDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-regular fa-user-circle me-1"></i>
                            {{ auth()->user()->name ?? (auth()->user()->username ?? 'User') }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarUserDropdown">
                            @if (auth()->user()->level === 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"
                                        target="_blank">Dashboard</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            @endif
                            <li><a class="dropdown-item" href="{{ route('booking.history') }}">Riwayat Booking</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="{{ route('logout') }}">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
