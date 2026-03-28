@extends('admin.layouts.main')

@section('title', '')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-brown border-bottom py-3 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Form Tambah Tari</h5>
                    <a href="{{ route('admin.tari.index') }}" class="btn btn-outline-warning btn-sm">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
                <div class="card-body text-white">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0 ps-3">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.tari.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Tari</label>
                            <input type="text" class="form-control" id="nama" name="nama"
                                value="{{ old('nama') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga per Penari</label>
                            <input type="number" class="form-control" id="harga" name="harga" min="0"
                                step="0.01" value="{{ old('harga') }}" required>
                        </div>

                        <div class="mb-4">
                            <label for="gambar" class="form-label">Gambar (opsional)</label>
                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                        </div>

                        <button type="submit" class="btn btn-warning">Simpan</button>
                        <a href="{{ route('admin.tari.index') }}" class="btn btn-dark">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
