@extends('admin.layouts.main')

@section('title', 'Dashboard')

@section('content')
    {{-- <div class="row">
        <div class="col-md-12">
            <h3>Welcome to the Admin Dashboard</h3>
            <p>This is a simple admin dashboard template.</p>
        </div>
    </div> --}}

    <!-- 4 Summary Cards -->
    <div class="row g-3 mb-4">
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded text-primary me-3">
                        <i class="fa-solid fa-users fs-4"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Users</h6>
                        <h3 class="mb-0 fw-bold">{{ $usersCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded text-success me-3">
                        <i class="fa-solid fa-list-check fs-4"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Booking</h6>
                        <h3 class="mb-0 fw-bold">{{ $bookingCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-3 rounded text-warning me-3">
                        <i class="fa-solid fa-wallet fs-4"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Total Pemasukan</h6>
                        <h3 class="mb-0 fw-bold fs-4">Rp{{ number_format($approvedOrderTotal ?? 0, 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-3 rounded text-danger me-3">
                        <i class="fa-solid fa-calendar-alt fs-4"></i>
                    </div>
                    <div>
                        <h6 class="card-title text-muted mb-1">Jadwal Pentas</h6>
                        <h3 class="mb-0 fw-bold">{{ $approvedBookingCount ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Simple Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-brown border-bottom py-3">
            <h5 class="card-title mb-0">Jadwal Pentas</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="jadwal-table">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th class="ps-4">Nama Pentas</th>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>Lokasi</th>
                            <th class="pe-4 text-end">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwalPentas as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="ps-4">{{ $jadwal->tari->nama ?? '-' }}</td>
                                <td>{{ optional($jadwal->tanggal_tampil)->format('d-m-Y') ?? '-' }}</td>
                                <td>-</td>
                                <td>{{ $jadwal->alamat_pentas }}</td>
                                <td class="pe-4 text-end">
                                    @if ($jadwal->status === 'approved')
                                        <span class="badge bg-success">Terjadwal</span>
                                    @elseif ($jadwal->status === 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif ($jadwal->status === 'rejected')
                                        <span class="badge bg-danger">Ditolak</span>
                                    @else
                                        <span class="badge bg-secondary">{{ ucfirst($jadwal->status) }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">Belum ada jadwal pentas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        // Inisialisasi DataTables
        $(document).ready(function() {
            $('#jadwal-table').DataTable({
                "lengthChange": true,
                "pageLength": 10,
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_ jadwal",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Berikutnya"
                    },
                    "info": "Menampilkan _START_ - _END_ dari _TOTAL_ jadwal",
                    "infoEmpty": "Tidak ada jadwal yang tersedia",
                    "emptyTable": "Tidak ada jadwal yang tersedia",
                    "zeroRecords": "Tidak ada jadwal yang ditemukan"
                }
            });

            // Konfirmasi sebelum logout
            $(document).on('click', '.js-logout-link', function(e) {
                e.preventDefault();
                const logoutUrl = $(this).attr('href');

                Swal.fire({
                    title: 'Yakin ingin keluar?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, keluar',
                    cancelButtonText: 'Batal',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = logoutUrl;
                    }
                });
            });
        });
    </script>
@endpush
