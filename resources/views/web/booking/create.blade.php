@extends('web.layouts.content')

@section('title', 'Booking Tari - Prabhakala E-Booking')

@section('content')
    <section class="booking-create-section">
        <div class="container">
            <!-- Dance Info Card -->
            <div class="booking-card booking-card-detail">
                <div class="booking-card-image">
                    <img src="{{ asset('images/gallery.png') }}" alt="Tari Gambyong">
                </div>
                <div class="booking-card-content">
                    <h2 class="booking-card-title">Tari Gambyong</h2>
                    <p class="booking-card-desc">
                        Tari Gambyong Adalah Tarian Tradisional Klasik Dari Surakarta, Jawa Tengah, Yang Melambangkan Keanggunan, Keluwesan, Dan Kecantikan Seorang Wanita. Awalnya Merupakan Tari Rakyat (Tayub) Untuk Ritual Kesuburan, Kini Tari Ini Populer Sebagai Tarian Penyambutan Tamu.
                    </p>
                    <div class="booking-card-price text-end">
                        <span class="price-label">Harga/penari</span>
                        <span class="price-value">Rp 450.000,00</span>
                    </div>
                </div>
            </div>

            <!-- Booking Form -->
            <div class="booking-form-card">
                <form action="{{ url('/booking/store') }}" method="POST">
                    @csrf
                    <div class="booking-form-row">
                        <label class="booking-form-label">Nama Pemesan</label>
                        <span class="booking-form-colon">:</span>
                        <input type="text" class="form-control booking-form-input" name="nama_pemesan" required>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">Alamat Pentas</label>
                        <span class="booking-form-colon">:</span>
                        <textarea class="form-control booking-form-textarea" name="alamat_pentas" rows="4" required></textarea>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">No. Telp</label>
                        <span class="booking-form-colon">:</span>
                        <input type="tel" class="form-control booking-form-input" name="no_telp" required>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">Tanggal Tampil</label>
                        <span class="booking-form-colon">:</span>
                        <input type="date" class="form-control booking-form-input booking-form-date" name="tanggal_tampil" required>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">Catatan</label>
                        <span class="booking-form-colon">:</span>
                        <textarea class="form-control booking-form-textarea" name="catatan" rows="4"></textarea>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">Pilih Jumlah Penari</label>
                        <span class="booking-form-colon">:</span>
                        <select class="form-select booking-form-select" name="jumlah_penari" id="jumlahPenari" required>
                            {{-- <option value="" selected disabled></option> --}}
                            <option value="1" selected>1 Penari</option>
                            <option value="2">2 Penari</option>
                            <option value="3">3 Penari</option>
                            <option value="4">4 Penari</option>
                            <option value="5">5 Penari</option>
                        </select>
                    </div>

                    <div class="booking-form-row">
                        <label class="booking-form-label">TOTAL</label>
                        <span class="booking-form-colon">:</span>
                        <input type="text" class="form-control booking-form-input booking-form-total" id="totalHarga" value="Rp 450.000,00" readonly>
                    </div>
                </form>
            </div>

            <!-- Submit Button -->
            <div class="booking-submit-wrapper">
                <button type="submit" class="btn btn-booking-submit" form="bookingForm">Pesan Sekarang</button>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    document.getElementById('jumlahPenari').addEventListener('change', function() {
        const hargaPerPenari = 450000;
        const jumlah = parseInt(this.value) || 1;
        const total = hargaPerPenari * jumlah;
        document.getElementById('totalHarga').value = 'Rp ' + total.toLocaleString('id-ID') + ',00';
    });
</script>
@endpush
