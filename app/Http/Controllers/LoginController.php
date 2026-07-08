<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Menampilkan halaman login
     */
    public function index()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('login')) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    /**
     * Proses login
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('username', $request->username)->first();

        if (!$user) {
            return redirect('/login')
                ->with('error', 'Username tidak ditemukan')
                ->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return redirect('/login')
                ->with('error', 'Password salah')
                ->withInput();
        }

        // Simpan session
        session([
            'login' => true,
            'user_id' => $user->id_user,
            'nama' => $user->nama,
            'username' => $user->username
        ]);

        return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->nama . '!');
    }

    /**
     * Proses LOGOUT
     */
    public function logout(Request $request)
    {
        // Hapus semua session
        $request->session()->flush();
        
        // Hapus session secara spesifik (opsional)
        // session()->forget(['login', 'user_id', 'nama', 'username']);
        
        // Redirect ke halaman login dengan pesan
        return redirect('/login')->with('success', 'Anda telah logout!');
    }
}