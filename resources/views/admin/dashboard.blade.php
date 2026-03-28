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
                        <h6 class="card-title text-muted mb-1">Pelanggan</h6>
                        <h3 class="mb-0 fw-bold">15</h3>
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
                        <h3 class="mb-0 fw-bold">20</h3>
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
                        <h6 class="card-title text-muted mb-1">Order Masuk</h6>
                        <h3 class="mb-0 fw-bold fs-4">Rp10.000.000</h3>
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
                        <h3 class="mb-0 fw-bold">14</h3>
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
                        <tr>
                            <td>1</td>
                            <td class="ps-4">Tari Topeng Cirebon</td>
                            <td>01-03-2026</td>
                            <td>19:00</td>
                            <td>Gedung Kesenian</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td class="ps-4">Tari Saman Aceh</td>
                            <td>02-03-2026</td>
                            <td>20:00</td>
                            <td>Balai Budaya</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td class="ps-4">Tari Pendet Bali</td>
                            <td>03-03-2026</td>
                            <td>18:30</td>
                            <td>Aula Seni Pertunjukan</td>
                            <td class="pe-4 text-end"><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td class="ps-4">Tari Zapin Melayu</td>
                            <td>04-03-2026</td>
                            <td>19:30</td>
                            <td>Gedung Kesenian</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td class="ps-4">Tari Kuda Lumping Jawa</td>
                            <td>05-03-2026</td>
                            <td>20:00</td>
                            <td>Balai Budaya</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td class="ps-4">Tari Legong Keraton Bali</td>
                            <td>06-03-2026</td>
                            <td>19:00</td>
                            <td>Aula Seni Pertunjukan</td>
                            <td class="pe-4 text-end"><span class="badge bg-warning">Pending</span></td>
                        </tr>
                        <tr>
                            <td>7</td>
                            <td class="ps-4">Tari Poco-poco Kalimantan</td>
                            <td>07-03-2026</td>
                            <td>18:00</td>
                            <td>Gedung Kesenian</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>8</td>
                            <td class="ps-4">Tari Remo Jawa Timur</td>
                            <td>08-03-2026</td>
                            <td>19:30</td>
                            <td>Balai Budaya</td>
                            <td class="pe-4 text-end"><span class="badge bg-danger">Ditolak</span></td>
                        </tr>
                        <tr>
                            <td>9</td>
                            <td class="ps-4">Tari Serimpi Yogyakarta</td>
                            <td>09-03-2026</td>
                            <td>20:00</td>
                            <td>Aula Seni Pertunjukan</td>
                            <td class="pe-4 text-end"><span class="badge bg-success">Terjadwal</span></td>
                        </tr>
                        <tr>
                            <td>10</td>
                            <td class="ps-4">Tari Jaipong Sunda</td>
                            <td>10-03-2026</td>
                            <td>19:00</td>
                            <td>Gedung Kesenian</td>
                            <td class="pe-4 text-end"><span class="badge bg-warning">Pending</span></td>
                        </tr>
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
                    title: 'Apakah yakin ingin keluar?',
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
