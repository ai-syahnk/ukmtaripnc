@extends('admin.layouts.main')

@section('title', '')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Booking</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="bookingTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Booking</th>
                                <th>Pemesan</th>
                                <th>Tari</th>
                                <th>Tanggal Tampil</th>
                                <th>Waktu Tampil</th>
                                <th>Jumlah Penari</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th width="170">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($bookings as $index => $booking)
                            @php
                            $badgeClass = match ($booking->status) {
                            'approved' => 'warning',
                            'rejected' => 'danger',
                            'waiting_confirmation' => 'info',
                            'paid' => 'success',
                            'payment_rejected' => 'danger',
                            'expired' => 'dark',
                            default => 'secondary',
                            };
                            $statusLabel = match ($booking->status) {
                            'approved' => 'Approved',
                            'rejected' => 'Rejected',
                            'waiting_confirmation' => 'Menunggu Konfirmasi',
                            'paid' => 'Lunas',
                            'payment_rejected' => 'Bayar Ditolak',
                            'expired' => 'Kadaluarsa',
                            default => 'Pending',
                            };
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $booking->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $booking->nama_pemesan }}</div>
                                    <small class="text-muted">{{ $booking->user?->no_telp ?? '-' }}</small>
                                </td>
                                <td>{{ $booking->tari?->nama ?? '-' }}</td>
                                <td>{{ $booking->tanggal_tampil?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $booking->waktu_tampil ?
                                    \Carbon\Carbon::parse($booking->waktu_tampil)->format('H:i') : '-' }}</td>
                                <td>{{ $booking->jumlah_penari }} Penari</td>
                                <td>Rp {{ number_format((float) $booking->total_harga, 2, ',', '.') }}</td>
                                <td>
                                    <span class="badge bg-{{ $badgeClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>
                                    @if (in_array($booking->status, ['pending', 'approved', 'rejected']))
                                    <form action="{{ route('admin.booking.update-status', $booking) }}" method="POST"
                                        class="d-flex gap-2 align-items-center js-status-form"
                                        data-id="{{ $booking->id }}">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" class="form-select form-select-sm" required>
                                            <option value="pending" {{ $booking->status === 'pending' ? 'selected' : ''
                                                }}>
                                                Pending
                                            </option>
                                            <option value="approved" {{ $booking->status === 'approved' ? 'selected' :
                                                '' }}>
                                                Approved
                                            </option>
                                            <option value="rejected" {{ $booking->status === 'rejected' ? 'selected' :
                                                '' }}>
                                                Rejected
                                            </option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-warning">Simpan</button>
                                    </form>
                                    @elseif ($booking->status === 'waiting_confirmation')
                                    <a href="{{ route('admin.payment.index') }}" class="btn btn-sm btn-info text-white">
                                        <i class="fas fa-credit-card"></i> Verifikasi
                                    </a>
                                    @elseif ($booking->status === 'paid')
                                    <a href="{{ route('booking.invoice', $booking) }}" class="btn btn-sm btn-success">
                                        <i class="fas fa-file-invoice"></i> Invoice
                                    </a>
                                    @else
                                    <span class="text-muted">-</span>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(function() {
            $('#bookingTable').DataTable({
                pageLength: 10,
                order: [
                    [1, 'desc']
                ],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ booking',
                    paginate: {
                        previous: 'Sebelumnya',
                        next: 'Berikutnya'
                    },
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ booking',
                    infoEmpty: 'Tidak ada booking yang tersedia',
                    emptyTable: 'Tidak ada booking yang tersedia',
                    zeroRecords: 'Tidak ada booking yang ditemukan'
                }
            });

            @if (session('toast_success'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('toast_success') }}',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true
                });
            @endif

            @if (session('toast_error'))
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'error',
                    title: '{{ session('toast_error') }}',
                    showConfirmButton: false,
                    timer: 5000,
                    timerProgressBar: true
                });
            @endif
        });
</script>
@endpush