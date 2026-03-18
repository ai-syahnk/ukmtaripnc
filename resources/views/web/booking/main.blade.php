@extends('web.layouts.content')

@section('title', 'Booking - Prabhakala E-Booking')

@section('content')
    <section class="booking-section">
        <div class="container">
            <!-- Booking Card 1 -->
            <div class="booking-card">
                <div class="booking-card-image">
                    <img src="{{ asset('images/gallery.png') }}" alt="Tari Gambyong">
                </div>
                <div class="booking-card-content">
                    <h2 class="booking-card-title">Tari Gambyong</h2>
                    <p class="booking-card-desc">
                        Tari Gambyong Adalah Tarian Tradisional Klasik Dari Surakarta, Jawa Tengah, Yang Melambangkan Keanggunan, Keluwesan, Dan Kecantikan Seorang Wanita. Awalnya Merupakan Tari Rakyat (Tayub) Untuk Ritual Kesuburan, Kini Tari Ini Populer Sebagai Tarian Penyambutan Tamu.
                    </p>
                    <div class="booking-card-footer">
                        <a href="{{ url('/booking/create') }}" class="btn btn-booking-lanjutkan">Lanjutkan</a>
                        <div class="booking-card-price">
                            <span class="price-label">Harga/penari</span>
                            <span class="price-value">Rp 450.000,00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Card 2 -->
            <div class="booking-card">
                <div class="booking-card-image">
                    <img src="{{ asset('images/gallery.png') }}" alt="Tari Gambyong">
                </div>
                <div class="booking-card-content">
                    <h2 class="booking-card-title">Tari Gambyong</h2>
                    <p class="booking-card-desc">
                        Tari Gambyong adalah tarian tradisional klasik dari Surakarta, Jawa Tengah, yang melambangkan keanggunan, keluwesan, dan kecantikan seorang wanita. Awalnya merupakan tari rakyat (Tayub) untuk ritual kesuburan, kini tari ini populer sebagai tarian penyambutan tamu.
                    </p>
                    <div class="booking-card-footer">
                        <a href="{{ url('/booking/create') }}" class="btn btn-booking-lanjutkan">Lanjutkan</a>
                        <div class="booking-card-price">
                            <span class="price-label">Harga/penari</span>
                            <span class="price-value">Rp 450.000,00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Card 3 -->
            <div class="booking-card">
                <div class="booking-card-image">
                    <img src="{{ asset('images/gallery.png') }}" alt="Tari Gambyong">
                </div>
                <div class="booking-card-content">
                    <h2 class="booking-card-title">Tari Gambyong</h2>
                    <p class="booking-card-desc">
                        Tari Gambyong adalah tarian tradisional klasik dari Surakarta, Jawa Tengah, yang melambangkan keanggunan, keluwesan, dan kecantikan seorang wanita. Awalnya merupakan tari rakyat (Tayub) untuk ritual kesuburan, kini tari ini populer sebagai tarian penyambutan tamu.
                    </p>
                    <div class="booking-card-footer">
                        <a href="{{ url('/booking/create') }}" class="btn btn-booking-lanjutkan">Lanjutkan</a>
                        <div class="booking-card-price">
                            <span class="price-label">Harga/penari</span>
                            <span class="price-value">Rp 450.000,00</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Booking Card 4 -->
            <div class="booking-card">
                <div class="booking-card-image">
                    <img src="{{ asset('images/gallery.png') }}" alt="Tari Gambyong">
                </div>
                <div class="booking-card-content">
                    <h2 class="booking-card-title">Tari Gambyong</h2>
                    <p class="booking-card-desc">
                        Tari Gambyong adalah tarian tradisional klasik dari Surakarta, Jawa Tengah, yang melambangkan keanggunan, keluwesan, dan kecantikan seorang wanita. Awalnya merupakan tari rakyat (Tayub) untuk ritual kesuburan, kini tari ini populer sebagai tarian penyambutan tamu.
                    </p>
                    <div class="booking-card-footer">
                        <a href="{{ url('/booking/create') }}" class="btn btn-booking-lanjutkan">Lanjutkan</a>
                        <div class="booking-card-price">
                            <span class="price-label">Harga/penari</span>
                            <span class="price-value">Rp 450.000,00</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
