@extends('web.layouts.content')

@section('title', 'Buat Akun - Prabhakala E-Booking')

@section('content')
    <section class="login-section">
        <div class="login-container">
            <div class="login-card">
                <h1 class="login-title">BUAT AKUN</h1>

                {{-- Pesan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Pesan sukses --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="name" placeholder="Nama Lengkap"
                            value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="username" placeholder="Username"
                            value="{{ old('username') }}" required>
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="alamat" placeholder="Alamat"
                            value="{{ old('alamat') }}" required>
                    </div>
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="no_telp" placeholder="Nomor Telepon"
                            value="{{ old('no_telp') }}" pattern="^\+?[0-9]+$"
                            title="Gunakan angka dan boleh diawali tanda +" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control login-input" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn login-btn">BUAT</button>
                        <p class="login-register-link">
                            Sudah punya akun? <a href="{{ url('/login') }}">Login</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
