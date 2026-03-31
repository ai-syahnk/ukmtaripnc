@extends('web.layouts.content')

@section('title', 'Informasi Booking - Prabhakala E-Booking')

@section('content')
<section class="booking-section py-5">
    <div class="container">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Informasi Booking</h5>
                <a href="{{ route('booking.index') }}" class="btn btn-outline-warning btn-sm">
                    <i class="fas fa-plus"></i> Booking Sekarang
                </a>
            </div>
            <div class="card-body">
                @if ($approvedBookings->isEmpty())
                <div class="p-4 text-center">
                    <h5 class="mb-2">Belum Ada Booking</h5>
                    <p class="text-muted mb-3">Saat ini belum ada jadwal booking.</p>
                    <a href="{{ route('booking.index') }}" class="btn btn-warning">Lihat Daftar Tari</a>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0 align-middle" id="bookingTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Tanggal Tampil</th>
                                <th>Waktu Tampil</th>
                                <th>Nama Tari</th>
                                <th>Jumlah Penari</th>
                                <th>Lokasi Pentas</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approvedBookings as $booking)
                            <tr>
                                <td>{{ $approvedBookings->firstItem() + $loop->index }}</td>
                                <td>{{ $booking->tanggal_tampil?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $booking->waktu_tampil ?
                                    \Carbon\Carbon::parse($booking->waktu_tampil)->format('H:i') : '-' }}</td>
                                <td>{{ $booking->tari?->nama ?? '-' }}</td>
                                <td>{{ $booking->jumlah_penari }} Penari</td>
                                <td>{{ $booking->alamat_pentas }}</td>
                                <td>
                                    @if ($booking->status === 'approved')
                                    <span class="badge text-bg-primary text-uppercase">{{ $booking->status }}</span>
                                    @elseif ($booking->status === 'paid')
                                    <span class="badge text-bg-success text-uppercase">{{ $booking->status }}</span>
                                    @elseif ($booking->status === 'pending')
                                    <span class="badge text-bg-warning text-uppercase">{{ $booking->status }}</span>
                                    @elseif ($booking->status === 'rejected')
                                    <span class="badge text-bg-danger text-uppercase">{{ $booking->status }}</span>
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

        @if ($approvedBookings->hasPages())
        <div class="mt-4">
            {{ $approvedBookings->links() }}
        </div>
        @endif
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Inisialisasi DataTables
        $(function() {
            $('#bookingTable').DataTable({
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