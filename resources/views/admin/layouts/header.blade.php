<!-- Header -->
<header class="header px-4 py-3 bg-white shadow-sm d-flex align-items-center justify-content-between">
    <button class="btn btn-light toggle-sidebar" id="toggle-sidebar">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-regular fa-user-circle me-1"></i> {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            {{-- <li><a class="dropdown-item" href="#">Profile</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li> --}}
            <li>
                <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item text-danger js-logout-link" href="{{ route('logout') }}">Logout</a></li>
        </ul>
    </div>
</header>
