@extends('web.layouts.content')

@section('title', 'Pembayaran Booking - Prabhakala E-Booking')

@section('content')
<section class="booking-section py-5">
    <div class="container" style="max-width: 800px;">
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-header bg-brown border-bottom py-3">
                <h5 class="card-title mb-0">Pembayaran Booking</h5>
            </div>
            <div class="card-body">
                {{-- Detail Booking --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Detail Booking</h6>
                    <table class="table table-borderless table-sm mb-0">
                        <tr>
                            <td class="text-muted" style="width:160px">Nama Tari</td>
                            <td>: {{ $booking->tari?->nama ?? '-' }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Tanggal Tampil</td>
                            <td>: {{ $booking->tanggal_tampil?->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Waktu Tampil</td>
                            <td>: {{ $booking->waktu_tampil ? \Carbon\Carbon::parse($booking->waktu_tampil)->format('H:i') : '' }} WIB</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Jumlah Penari</td>
                            <td>: {{ $booking->jumlah_penari }} Penari</td>
                        </tr>
                        <tr>
                            <td class="text-muted">Harga per Penari</td>
                            <td>: Rp {{ number_format((float) $booking->harga_per_penari, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td class="text-muted fw-bold">Total Bayar</td>
                            <td class="fw-bold text-warning">: Rp {{ number_format((float) $booking->total_harga, 0,
                                ',',
                                '.') }}</td>
                        </tr>
                    </table>
                </div>

                <hr>

                {{-- Info Rekening --}}
                <div class="mb-4">
                    <h6 class="fw-bold mb-3">Transfer ke Rekening</h6>
                    <div class="bg-dark rounded p-3">
                        <table class="table table-borderless table-sm mb-0">
                            <tr>
                                <td class="text-muted" style="width:160px">Bank</td>
                                <td>: <strong>{{ $bankConfig['bank_name'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Nomor Rekening</td>
                                <td>: <strong>{{ $bankConfig['account_number'] }}</strong></td>
                            </tr>
                            <tr>
                                <td class="text-muted">Atas Nama</td>
                                <td>: <strong>{{ $bankConfig['account_holder'] }}</strong></td>
                            </tr>
                        </table>
                    </div>
                </div>

                {{-- Countdown --}}
                @if ($booking->payment_deadline)
                <div class="alert alert-warning d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-clock me-2"></i>
                    <div>
                        Batas waktu pembayaran:
                        <strong id="countdown">{{ $booking->payment_deadline->format('d/m/Y H:i') }}</strong>
                    </div>
                </div>
                @endif

                {{-- Alasan Reject (jika payment_rejected) --}}
                @if ($booking->status === 'payment_rejected' && $booking->latestPayment?->catatan_admin)
                <div class="alert alert-danger mb-4">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Pembayaran sebelumnya ditolak:</strong>
                    {{ $booking->latestPayment->catatan_admin }}
                </div>
                @endif

                <hr>

                {{-- Form Upload Bukti --}}
                <div>
                    <h6 class="fw-bold mb-3">Upload Bukti Pembayaran</h6>
                    <form action="{{ route('booking.payment.store', $booking) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Nama Pengirim <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nama_pengirim') is-invalid @enderror"
                                id="nama_pengirim" name="nama_pengirim" value="{{ old('nama_pengirim') }}" required>
                            @error('nama_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bank_pengirim" class="form-label">Bank Pengirim <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('bank_pengirim') is-invalid @enderror"
                                id="bank_pengirim" name="bank_pengirim" value="{{ old('bank_pengirim') }}"
                                placeholder="Contoh: BCA, BRI, Mandiri" required>
                            @error('bank_pengirim')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_transfer" class="form-label">Jumlah Transfer (Rp) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('jumlah_transfer') is-invalid @enderror"
                                id="jumlah_transfer" name="jumlah_transfer" value="{{ old('jumlah_transfer') }}" min="1"
                                step="1" required>
                            @error('jumlah_transfer')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror"
                                id="bukti_pembayaran" name="bukti_pembayaran" accept="image/jpeg,image/png,image/jpg"
                                required>
                            <div class="form-text">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                            @error('bukti_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Preview --}}
                        <div class="mb-3" id="preview-wrapper" style="display:none">
                            <img id="preview-image" src="" alt="Preview" class="img-thumbnail" style="max-height:300px">
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('booking.history') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-warning">Upload Bukti Pembayaran</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Image preview
        document.getElementById('bukti_pembayaran').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const wrapper = document.getElementById('preview-wrapper');
            const img = document.getElementById('preview-image');
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    img.src = ev.target.result;
                    wrapper.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                wrapper.style.display = 'none';
            }
        });

        // Countdown timer
        @if ($booking->payment_deadline)
            (function() {
                const deadline = new Date('{{ $booking->payment_deadline->toIso8601String() }}').getTime();
                const el = document.getElementById('countdown');

                function update() {
                    const now = new Date().getTime();
                    const diff = deadline - now;

                    if (diff <= 0) {
                        el.textContent = 'WAKTU HABIS';
                        el.classList.add('text-danger');
                        return;
                    }

                    const hours = Math.floor(diff / (1000 * 60 * 60));
                    const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((diff % (1000 * 60)) / 1000);

                    el.textContent = hours + ' jam ' + minutes + ' menit ' + seconds + ' detik tersisa';
                    setTimeout(update, 1000);
                }
                update();
            })();
        @endif
</script>
@endpush