@extends('web.layouts.content')

@section('title', 'Login - Prabhakala E-Booking')

@section('content')
    <section class="login-section">
        <div class="login-container">
            <div class="login-card">
                <h1 class="login-title">LOGIN</h1>

                @if (session('success'))
                    <div class="alert alert-success" style="background: #d4edda; color: #155724; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->has('login'))
                    <div class="alert alert-danger" style="background: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 8px; margin-bottom: 15px; text-align: center; font-size: 14px;">
                        {{ $errors->first('login') }}
                    </div>
                @endif

                <form action="{{ url('/login') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <input type="text" class="form-control login-input" name="username" placeholder="Username"
                            value="{{ old('username') }}" required>
                        @error('username')
                            <small style="color: #dc3545; font-size: 12px;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <input type="password" class="form-control login-input" name="password" placeholder="Password"
                            required>
                        @error('password')
                            <small style="color: #dc3545; font-size: 12px;">{{ $message }}</small>
                        @enderror
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

