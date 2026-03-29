@extends('web.layouts.content')

@section('title', 'Beranda - Prabhakala E-Booking')

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="5000">
            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true"
                    aria-label="Slide 1"></button>
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
                            <img src="{{ asset('images/tari/gambyong.jpg') }}" alt="Galeri 1" onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/tari/serimpi.jpeg') }}" alt="Galeri 2" onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/tari/bedhaya.webp') }}" alt="Galeri 3" onerror="this.style.display='none'">
                        </div>
                        <span class="gallery-card-label">Tentang Kami</span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-3">
                    <div class="gallery-card">
                        <div class="gallery-card-image">
                            <img src="{{ asset('images/tari/bondan.webp') }}" alt="Galeri 4" onerror="this.style.display='none'">
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
@endsection
