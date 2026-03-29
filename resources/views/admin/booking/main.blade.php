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
                                            'approved' => 'success',
                                            'rejected' => 'danger',
                                            default => 'warning',
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
                                        <td>{{ $booking->jumlah_penari }} Penari</td>
                                        <td>Rp {{ number_format((float) $booking->total_harga, 2, ',', '.') }}</td>
                                        <td>
                                            <span
                                                class="badge bg-{{ $badgeClass }} text-uppercase">{{ $booking->status }}</span>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.booking.update-status', $booking) }}"
                                                method="POST" class="d-flex gap-2 align-items-center js-status-form"
                                                data-id="{{ $booking->id }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" class="form-select form-select-sm" required>
                                                    <option value="pending"
                                                        {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="approved"
                                                        {{ $booking->status === 'approved' ? 'selected' : '' }}>
                                                        Approved
                                                    </option>
                                                    <option value="rejected"
                                                        {{ $booking->status === 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>
                                                <button type="submit" class="btn btn-sm btn-warning">Simpan</button>
                                            </form>
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
