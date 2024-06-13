<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Vote;
use App\Models\User;
use App\Models\Calon;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = \App\Models\User::count();
        $totalCalon = \App\Models\Calon::count();
        $totalAdmin = \App\Models\Admin::count();

        // Mendapatkan pemilihan pertama
        $pemilihan = Voting::first();

        // Mendapatkan detail calon dalam voting
        $detailCalon = $pemilihan->calonVotings;

        // Mendapatkan jumlah suara yang memilih calon menggunakan join dan agregasi
        $detailSuara = Vote::join('calon', 'vote.id_calon', '=', 'calon.id_calon')
                            ->select('calon.ketua_calon', \DB::raw('COUNT(vote.id_calon) as suara_count'))
                            ->groupBy('calon.ketua_calon')
                            ->get();

        // Menyiapkan data untuk diagram pie
        $labels = $detailSuara->pluck('ketua_calon');
        $data = $detailSuara->pluck('suara_count');

        // Menghitung jumlah yang sudah memilih
        $jumlahMemilih = Vote::distinct('nisn')->count();
        $jumlahBelumMemilih = $totalUsers - $jumlahMemilih;

        return view('admin.home', compact('totalUsers', 'totalCalon', 'totalAdmin', 'detailCalon', 'labels', 'data', 'pemilihan', 'jumlahMemilih', 'jumlahBelumMemilih'));
    }
}
