@extends('admin.layouts.main')

@section('title', 'Verifikasi Pembayaran')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Daftar Pembayaran</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="paymentTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Upload</th>
                                <th>Pemesan</th>
                                <th>Tari</th>
                                <th>Tgl. & Waktu Tampil</th>
                                <th>Total Booking</th>
                                <th>Jumlah Transfer</th>
                                <th>Bank</th>
                                <th>Status</th>
                                <th width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                            @php
                            $badgeClass = match ($payment->status) {
                            'confirmed' => 'success',
                            'rejected' => 'danger',
                            default => 'warning',
                            };
                            $statusLabel = match ($payment->status) {
                            'confirmed' => 'Dikonfirmasi',
                            'rejected' => 'Ditolak',
                            default => 'Menunggu',
                            };
                            @endphp
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $payment->created_at?->format('d/m/Y H:i') ?? '-' }}</td>
                                <td>
                                    <div class="fw-semibold">{{ $payment->booking?->nama_pemesan ?? '-' }}</div>
                                    <small class="text-muted">Pengirim: {{ $payment->nama_pengirim }}</small>
                                </td>
                                <td>{{ $payment->booking?->tari?->nama ?? '-' }} ({{ $payment->booking?->jumlah_penari
                                    ?? 0 }} Penari)</td>
                                <td>{{ $payment->booking?->tanggal_tampil?->format('d/m/Y') ?? '-' }} {{
                                    $payment->booking?->waktu_tampil ?
                                    \Carbon\Carbon::parse($payment->booking->waktu_tampil)->format('H:i') : '' }}</td>
                                <td>Rp {{ number_format((float) ($payment->booking?->total_harga ?? 0), 0, ',', '.') }}
                                </td>
                                <td>Rp {{ number_format((float) $payment->jumlah_transfer, 0, ',', '.') }}</td>
                                <td>{{ $payment->bank_pengirim }}</td>
                                <td>
                                    <span class="badge bg-{{ $badgeClass }}">{{ $statusLabel }}</span>
                                </td>
                                <td>
                                    {{-- Lihat Bukti --}}
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal"
                                        data-bs-target="#buktiModal{{ $payment->id }}">
                                        <i class="fas fa-image"></i>
                                    </button>

                                    @if ($payment->status === 'pending')
                                    {{-- Konfirmasi --}}
                                    <form action="{{ route('admin.payment.verify', $payment) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="status" value="confirmed">
                                        <button type="submit" class="btn btn-sm btn-success"
                                            onclick="return confirm('Konfirmasi pembayaran ini?')">
                                            <i class="fas fa-check"></i> Konfirmasi
                                        </button>
                                    </form>

                                    {{-- Tolak --}}
                                    <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#rejectModal{{ $payment->id }}">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                    @endif

                                    @if ($payment->catatan_admin)
                                    <br><small class="text-muted mt-1 d-block">{{ $payment->catatan_admin }}</small>
                                    @endif
                                </td>
                            </tr>

                            {{-- Modal Bukti --}}
                            <div class="modal fade" id="buktiModal{{ $payment->id }}" tabindex="-1">
                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Bukti Pembayaran</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body text-center">
                                            <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}"
                                                alt="Bukti Pembayaran" class="img-fluid rounded">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Tolak --}}
                            <div class="modal fade" id="rejectModal{{ $payment->id }}" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.payment.verify', $payment) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="rejected">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tolak Pembayaran</h5>
                                                <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Pembayaran dari <strong>{{ $payment->booking?->nama_pemesan ?? '-'
                                                        }}</strong></p>
                                                <div class="mb-3">
                                                    <label for="catatan_admin_{{ $payment->id }}"
                                                        class="form-label">Alasan Penolakan</label>
                                                    <textarea class="form-control" name="catatan_admin"
                                                        id="catatan_admin_{{ $payment->id }}" rows="3"
                                                        placeholder="Masukkan alasan penolakan..."></textarea>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">Tolak Pembayaran</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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
            $('#paymentTable').DataTable({
                pageLength: 10,
                order: [[1, 'desc']],
                language: {
                    search: 'Cari:',
                    lengthMenu: 'Tampilkan _MENU_ pembayaran',
                    paginate: { previous: 'Sebelumnya', next: 'Berikutnya' },
                    info: 'Menampilkan _START_ - _END_ dari _TOTAL_ pembayaran',
                    infoEmpty: 'Tidak ada pembayaran yang tersedia',
                    emptyTable: 'Tidak ada pembayaran yang tersedia',
                    zeroRecords: 'Tidak ada pembayaran yang ditemukan'
                }
            });

            @if (session('toast_success'))
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'success',
                    title: '{{ session('toast_success') }}',
                    showConfirmButton: false, timer: 3000, timerProgressBar: true
                });
            @endif

            @if (session('toast_error'))
                Swal.fire({
                    toast: true, position: 'top-end', icon: 'error',
                    title: '{{ session('toast_error') }}',
                    showConfirmButton: false, timer: 5000, timerProgressBar: true
                });
            @endif
        });
</script>
@endpush