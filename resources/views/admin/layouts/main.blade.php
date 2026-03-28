<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prabhakala E-Booking - Admin Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('templates/admin/assets/css/app.css') }}">
</head>

<body>
    <div class="wrapper">
        {{-- sidebar --}}
        @includeIf('admin.layouts.sidebar')

        <!-- Main Content -->
        <div class="main">
            {{-- header --}}
            @includeIf('admin.layouts.header')

            <!-- Content Area -->
            <main class="content p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="h4 mb-0">
                        @yield('title')
                    </h2>
                </div>

                @yield('content')
            </main>

            <!-- Footer -->
            {{-- <footer class="footer mt-auto p-4 bg-white text-muted text-center border-top">
                &copy; <span id="year"></span> PRABHAKALA E-BOOKING
            </footer> --}}
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <!-- URUTAN SCRIPT (Penting!) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('templates/admin/assets/js/app.js') }}"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    {{-- Custom Scripts --}}
    @stack('script')
</body>

</html>
