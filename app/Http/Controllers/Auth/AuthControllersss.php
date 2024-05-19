<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validasi input barcode atau NISN sesuai kebutuhan
        $request->validate([
            'barcode' => 'required|string',
        ]);

        // Cari pengguna berdasarkan barcode atau NISN
        $user = User::where('barcode', $request->barcode)->first();

        if ($user) {
            // Pengguna ditemukan, lakukan proses autentikasi di sini
            // Misalnya, set session, token, dll.
            // Sesuaikan dengan kebutuhan aplikasi Anda

            // Redirect ke halaman pemilihan setelah login berhasil
            return redirect()->route('pemilihan');
        } else {
            // Jika pengguna tidak ditemukan, kembalikan ke halaman login dengan pesan error
            return back()->with('error', 'Barcode atau NISN tidak valid.');
        }
    }
}
