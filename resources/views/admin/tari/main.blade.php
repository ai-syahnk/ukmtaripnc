@extends('admin.layouts.main')

@section('title', '')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">List Tari</h5>
                    <a href="{{ route('admin.tari.create') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-plus"></i> Tambah Tari
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="tariTable">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th width="100">Gambar</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th width="140">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($taris as $index => $tari)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ $tari->gambar ? asset('storage/' . $tari->gambar) : asset('images/gallery.png') }}"
                                                alt="{{ $tari->nama }}" class="img-fluid rounded"
                                                style="max-height: 60px;">
                                        </td>
                                        <td>
                                            <div class="fw-semibold">{{ $tari->nama }}</div>
                                            <small
                                                class="text-muted">{{ \Illuminate\Support\Str::limit($tari->deskripsi, 80) }}</small>
                                        </td>
                                        <td>Rp {{ number_format($tari->harga, 2, ',', '.') }}</td>
                                        <td>
                                            <a href="{{ route('admin.tari.edit', $tari) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
                                            <form action="{{ route('admin.tari.destroy', $tari) }}" method="POST"
                                                class="d-inline js-delete-form" data-nama="{{ $tari->nama }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
            $('#tariTable').DataTable({
                pageLength: 10,
                order: [
                    [0, 'asc']
                ]
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

            $(document).on('submit', '.js-delete-form', function(e) {
                e.preventDefault();

                const form = this;
                const namaTari = form.dataset.nama || 'data ini';

                Swal.fire({
                    title: 'Hapus data?',
                    text: `Data ${namaTari} akan dihapus permanen.`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
