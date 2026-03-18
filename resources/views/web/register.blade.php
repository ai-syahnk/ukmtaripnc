@extends('web.layouts.content')

@section('title', 'Buat Akun - Prabhakala E-Booking')

@section('content')
    <section class="login-section">
        <div class="login-container">
            <div class="login-card">
                <h1 class="login-title">BUAT AKUN</h1>

                <form action="{{ url('/register') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="username" placeholder="Username" required>
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
