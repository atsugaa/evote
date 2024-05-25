<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voting;

class LandingController extends Controller
{
    public function index()
    {
        $pemilihan = [
            'nama' => 'Pemilihan Ketua OSIS',
            'deskripsi' => 'Pemilihan Ketua Organisasi Siswa Intra Sekolah (OSIS) tahun 2024.',
            'mulai' => '2024-05-15',
            'selesai' => '2024-05-20',
        ];

        return view('home',["pemilihan" => Voting::first()] );
    }
}
