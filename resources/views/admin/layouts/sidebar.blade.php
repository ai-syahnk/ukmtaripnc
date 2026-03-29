<!-- Sidebar -->
<aside class="sidebar" id="sidebar">
    <div class="sidebar-brand text-center py-3">
        <a href="/" class="text-decoration-none d-block">
            <img src="../../../images/logo.png" alt="Logo" class="img-fluid px-3" style="max-height: 55px;">
        </a>
    </div>
    <ul class="sidebar-nav list-unstyled p-3">
        <li class="sidebar-item mb-2">
            <a href="{{ route('admin.dashboard') }}"
                class="sidebar-link rounded p-2 d-block text-white text-decoration-none {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house me-2"></i> <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item mb-2">
            <a href="{{ route('admin.tari.index') }}"
                class="sidebar-link rounded p-2 d-block text-white text-decoration-none {{ request()->routeIs('admin.tari.*') ? 'active' : '' }}">
                <i class="fa-solid fa-list me-2"></i> <span>List Tari</span>
            </a>
        </li>
    </ul>
</aside>
