@extends('web.layouts.content')

@section('title', 'Booking - Prabhakala E-Booking')

@section('content')
    <section class="booking-section">
        <div class="container">
            @forelse ($taris as $tari)
                <div class="booking-card">
                    <div class="booking-card-image">
                        <img src="{{ $tari->gambar ? asset('storage/' . $tari->gambar) : asset('images/gallery.png') }}"
                            alt="{{ $tari->nama }}">
                    </div>
                    <div class="booking-card-content">
                        <h2 class="booking-card-title">{{ $tari->nama }}</h2>
                        <p class="booking-card-desc">
                            {{ $tari->deskripsi }}
                        </p>
                        <div class="booking-card-footer">
                            <a href="{{ route('booking.create', ['tari' => $tari->id]) }}"
                                class="btn btn-booking-lanjutkan">Lanjutkan</a>
                            <div class="booking-card-price">
                                <span class="price-label">Harga/penari</span>
                                <span class="price-value">Rp {{ number_format($tari->harga, 2, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="booking-card">
                    <div class="booking-card-content">
                        <h2 class="booking-card-title">Data Tari Belum Tersedia</h2>
                        <p class="booking-card-desc">
                            Silakan tambah data tari melalui halaman admin agar daftar booking dapat ditampilkan.
                        </p>
                    </div>
                </div>
            @endforelse
        </div>
    </section>
@endsection
