@extends('web.layouts.content')

@section('title', 'Login - Prabhakala E-Booking')

@section('content')
    <section class="login-section">
        <div class="login-container">
            <div class="login-card">
                <h1 class="login-title">LOGIN</h1>

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="username" placeholder="Username" required>
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control login-input" name="password" placeholder="Password"
                            required>
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn login-btn">LOGIN</button>
                        <p class="login-register-link">
                            Belum punya akun? <a href="{{ url('/register') }}">Buat</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
