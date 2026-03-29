<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('web.login');
    }

    public function showRegister()
    {
        return view('web.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'username' => 'required|string|min:3|max:50|unique:users,username',
            'alamat' => 'required|string|min:5|max:255',
            'no_telp' => ['required', 'string', 'min:10', 'max:20', 'regex:/^\+?\d+$/'],
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'name.min' => 'Nama minimal 3 karakter.',
            'name.max' => 'Nama maksimal 100 karakter.',
            'username.required' => 'Username wajib diisi.',
            'username.min' => 'Username minimal 3 karakter.',
            'username.max' => 'Username maksimal 50 karakter.',
            'username.unique' => 'Username sudah digunakan.',
            'alamat.required' => 'Alamat wajib diisi.',
            'alamat.min' => 'Alamat minimal 5 karakter.',
            'alamat.max' => 'Alamat maksimal 255 karakter.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'no_telp.min' => 'Nomor telepon minimal 10 karakter.',
            'no_telp.max' => 'Nomor telepon maksimal 20 karakter.',
            'no_telp.regex' => 'Nomor telepon hanya boleh berisi angka dan tanda + di awal.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'password' => $request->password,
            'level' => 'user',
        ]);

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            if (Auth::user()->level !== 'admin') {
                $intendedUrl = $request->session()->get('url.intended');

                if ($intendedUrl && str_contains($intendedUrl, '/admin')) {
                    $request->session()->forget('url.intended');
                }

                return redirect()->intended('/beranda');
            }

            return redirect()->intended('/admin/dashboard');
        }

        return back()->withErrors([
            'login' => 'Username atau password salah.',
        ])->withInput($request->only('username'));
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
