<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="UKM Seni Tari Prabhakala - Platform E-Booking Penari Politeknik Negeri Cilacap">

    <title>Beranda - Prabhakala E-Booking</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Berkshire+Swash&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        :root {
            --color-primary-dark: #231205;
            --color-secondary-dark: #422C22;
            --color-gold: #FEB407;
            --color-gold-light: #FBC602;
            --color-white: #FFFFFF;
            --color-text-muted: #B8B8B8;
            --font-brand: "Berkshire Swash", serif;
            --font-body: 'Inter', sans-serif;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: var(--font-body);
            background-color: var(--color-primary-dark);
            color: var(--color-white);
            overflow-x: hidden;
        }

        /* ==================== NAVBAR ==================== */
        .navbar-custom {
            background-color: var(--color-primary-dark);
            padding: 0.75rem 0;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .navbar-brand-custom img {
            height: 50px;
            width: auto;
            margin-right: 10px;
        }

        .navbar-brand-text {
            font-family: var(--font-brand);
            font-size: 1.25rem;
            font-weight: 400;
            font-style: normal;
            color: var(--color-gold);
            letter-spacing: 1px;
        }

        .navbar-custom .navbar-nav .nav-link {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 400;
            color: var(--color-gold);
            padding: 0.5rem 1.25rem;
            transition: color 0.3s ease;
        }

        .navbar-custom .navbar-nav .nav-link:hover,
        .navbar-custom .navbar-nav .nav-link.active {
            color: var(--color-gold-light);
        }

        .navbar-toggler-custom {
            border: 1px solid var(--color-gold);
            padding: 0.25rem 0.5rem;
        }

        .navbar-toggler-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='%23D4A84B' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        /* ==================== HERO SECTION ==================== */
        .hero-section {
            position: relative;
            width: 100%;
            height: 70vh;
            min-height: 400px;
            overflow: hidden;
            margin-top: 70px;
        }

        .hero-carousel,
        .hero-carousel .carousel-inner,
        .hero-carousel .carousel-item {
            height: 100%;
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
        }

        .hero-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 30%;
            background: linear-gradient(to top, var(--color-primary-dark), transparent);
            z-index: 1;
            pointer-events: none;
        }

        .hero-carousel .carousel-control-prev,
        .hero-carousel .carousel-control-next {
            width: 60px;
            opacity: 0.8;
            z-index: 2;
        }

        .hero-carousel .carousel-control-prev-icon,
        .hero-carousel .carousel-control-next-icon {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 20px;
            background-size: 50%;
        }

        .hero-carousel .carousel-control-prev:hover,
        .hero-carousel .carousel-control-next:hover {
            opacity: 1;
        }

        .hero-carousel .carousel-indicators {
            z-index: 2;
            margin-bottom: 30px;
        }

        .hero-carousel .carousel-indicators button {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.5);
            border: none;
        }

        .hero-carousel .carousel-indicators button.active {
            background-color: var(--color-gold);
        }

        /* ==================== ABOUT SECTION ==================== */
        .about-section {
            background-color: var(--color-primary-dark);
            padding: 4rem 0;
        }

        .section-label {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--color-gold);
            display: block;
            margin-bottom: 0.75rem;
        }

        .section-title {
            font-family: var(--font-body);
            font-size: 1.75rem;
            font-weight: 600;
            color: var(--color-white);
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .section-text {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 300;
            color: var(--color-white);
            line-height: 1.8;
            margin-bottom: 1rem;
        }

        /* ==================== GALLERY SECTION ==================== */
        .gallery-section {
            background-color: var(--color-secondary-dark);
            padding: 2rem 0 4rem;
        }

        .gallery-card {
            margin-bottom: 1.5rem;
        }

        .gallery-card-image {
            width: 100%;
            aspect-ratio: 4/3;
            background-color: var(--color-secondary-dark);
            border-radius: 4px;
            overflow: hidden;
        }

        .gallery-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-card:hover .gallery-card-image img {
            transform: scale(1.05);
        }

        .gallery-card-label {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--color-gold);
            margin-top: 0.75rem;
            display: block;
        }

        /* ==================== FOOTER ==================== */
        .site-footer {
            background-color: var(--color-primary-dark);
            padding: 3rem 0;
            border-top: 1px solid rgba(212, 168, 75, 0.1);
        }

        .footer-brand {
            font-family: var(--font-brand);
            font-size: 1.5rem;
            font-weight: 400;
            color: var(--color-gold);
            /* line-height: 1.3; */
        }

        .footer-heading {
            font-family: var(--font-body);
            font-size: 0.95rem;
            font-weight: 500;
            color: var(--color-white);
            margin-bottom: 1rem;
        }

        .footer-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-list li {
            font-family: var(--font-body);
            font-size: 0.9rem;
            font-weight: 400;
            color: var(--color-white);
            margin-bottom: 0.5rem;
            padding-left: 1rem;
            position: relative;
        }

        .footer-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 4px;
            background-color: var(--color-gold);
            border-radius: 50%;
        }

        /* ==================== RESPONSIVE ==================== */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: var(--color-primary-dark);
                padding: 1rem;
                margin-top: 0.5rem;
                border-radius: 4px;
            }

            .hero-section {
                height: 50vh;
            }

            .section-title {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 767.98px) {
            .hero-section {
                height: 40vh;
                margin-top: 65px;
            }

            .about-section {
                padding: 3rem 0;
            }

            .section-title {
                font-size: 1.25rem;
            }

            .footer-brand {
                font-size: 1.25rem;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 575.98px) {
            .navbar-brand-text {
                font-size: 1rem;
            }

            .navbar-brand-custom img {
                height: 40px;
            }
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
            <a class="navbar-brand-custom" href="{{ url('/beranda') }}">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Prabhakala" onerror="this.style.display='none'">
                <span class="navbar-brand-text">PRABHAKALA E-BOOKING</span>
            </a>

            <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ url('/beranda') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/booking') }}">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/login') }}">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <!-- Slides -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/hero.png') }}" alt="Penari Tradisional Prabhakala" class="hero-image">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/hero-1.jpg') }}" alt="Penari Tradisional Prabhakala 1" class="hero-image">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/hero-2.jpg') }}" alt="Penari Tradisional Prabhakala 2" class="hero-image">
                </div>
            </div>

            <!-- Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div class="hero-overlay"></div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <span class="section-label">Tentang Kami</span>
            <h1 class="section-title">UKM Seni Tari Prabakala Politeknik Negeri Cilacap</h1>
            <p class="section-text">
                UKM Seni Tari Prabhakala merupakan Unit Kegiatan Mahasiswa di lingkungan Politeknik Negeri Cilacap yang
                bergerak khususnya di bidang seni tari tradisional dan modern sebagai wadah pengembangan minat, bakat,
                dan kreativitas mahasiswa.
            </p>
            <p class="section-text">
                Melalui platform e-booking ini, kami menyediakan layanan pemesanan penari untuk berbagai kegiatan
                kampus, instansi, perusahaan, maupun acara umum lainnya. Dengan menjunjung profesionalisme dan kualitas
                penampilan, kami berkomitmen memberikan pertunjukan terbaik dalam setiap kesempatan.
            </p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="gallery-section">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/gallery.png') }}" alt="Galeri 1"
                                onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/gallery.png') }}" alt="Galeri 2"
                                onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/gallery.png') }}" alt="Galeri 3"
                                onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/gallery.png') }}" alt="Galeri 4"
                                onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 mb-4 mb-md-0">
                    <div class="footer-brand">
                        PRABHAKALA<br>E-BOOKING
                    </div>
                </div>
                <div class="col-12 col-md-8">
                    <h3 class="footer-heading">Ready for offers and cooperation</h3>
                    <ul class="footer-list">
                        <li>Traditional Dance</li>
                        <li>Modern Dance</li>
                        <li>Wedding Dance</li>
                        <li>Event Performance</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    </script>
</body>

</html>
