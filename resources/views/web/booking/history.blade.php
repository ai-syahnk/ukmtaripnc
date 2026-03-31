@extends('web.layouts.content')

@section('title', 'Riwayat Booking - Prabhakala E-Booking')

@section('content')
<section class="booking-section py-5">
    <div class="container">
        {{-- <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Riwayat Booking Saya</h2>
            <a href="{{ route('booking.index') }}" class="btn btn-warning">Booking Baru</a>
        </div> --}}

        <div class="card shadow-sm border-0">
            <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Riwayat Booking Saya</h5>
                <a href="{{ route('booking.index') }}" class="btn btn-outline-warning btn-sm">
                    <i class="fas fa-plus"></i> Booking Baru
                </a>
            </div>
            <div class="card-body">
                @if ($bookings->isEmpty())
                <div class="p-4 text-center">
                    <h5 class="mb-2">Belum Ada Riwayat Booking</h5>
                    <p class="text-muted mb-3">Anda belum pernah membuat booking tari.</p>
                    <a href="{{ route('booking.index') }}" class="btn btn-warning">Mulai Booking</a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle" id="booking-history-table">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Booking</th>
                                <th>Nama Tari</th>
                                <th>Tanggal Tampil</th>
                                <th>Waktu Tampil</th>
                                <th>Jumlah Penari</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $bookings->firstItem() + $loop->index }}</td>
                                <td>{{ $booking->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $booking->tari?->nama ?? '-' }}</td>
                                <td>{{ $booking->tanggal_tampil?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $booking->waktu_tampil ?
                                    \Carbon\Carbon::parse($booking->waktu_tampil)->format('H:i') : '-' }}</td>
                                <td>{{ $booking->jumlah_penari }} Penari</td>
                                <td>Rp {{ number_format((float) $booking->total_harga, 2, ',', '.') }}</td>
                                <td>
                                    @php
                                    $statusClass = match ($booking->status) {
                                    'approved' => 'warning',
                                    'rejected' => 'danger',
                                    'waiting_confirmation' => 'info',
                                    'paid' => 'success',
                                    'payment_rejected' => 'danger',
                                    'expired' => 'dark',
                                    default => 'secondary',
                                    };
                                    $statusLabel = match ($booking->status) {
                                    'approved' => 'Menunggu Bayar',
                                    'rejected' => 'Ditolak',
                                    'waiting_confirmation' => 'Menunggu Konfirmasi',
                                    'paid' => 'Lunas',
                                    'payment_rejected' => 'Bayar Ditolak',
                                    'expired' => 'Kadaluarsa',
                                    default => 'Pending',
                                    };
                                    @endphp
                                    <span class="badge text-bg-{{ $statusClass }}">
                                        {{ $statusLabel }}
                                    </span>
                                    @if ($booking->status === 'approved' && $booking->payment_deadline)
                                    <br>
                                    <small class="text-muted">
                                        Batas: {{ $booking->payment_deadline->format('d/m H:i') }}
                                    </small>
                                    @endif
                                </td>
                                <td>
                                    @if (in_array($booking->status, ['approved', 'payment_rejected']))
                                    <a href="{{ route('booking.payment', $booking) }}" class="btn btn-sm btn-warning">
                                        {{ $booking->status === 'payment_rejected' ? 'Upload Ulang' : 'Bayar' }}
                                    </a>
                                    @elseif ($booking->status === 'paid')
                                    <a href="{{ route('booking.invoice', $booking) }}" class="btn btn-sm btn-success">
                                        Invoice
                                    </a>
                                    @else
                                    -
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>
        </div>

        @if ($bookings->hasPages())
        <div class="mt-4">
            {{ $bookings->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Inisialisasi DataTables
        $(function() {
            $('#booking-history-table').DataTable({
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ booking",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    },
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ booking",
                    "infoEmpty": "Tidak ada booking yang tersedia",
                    "emptyTable": "Tidak ada booking yang tersedia",
                    "zeroRecords": "Tidak ada booking yang ditemukan"
                }
            });
        });
</script>
@endpush