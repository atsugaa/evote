<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Vote;

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

        // Mendapatkan jumlah suara yang memilih calon
        $detailSuara = Vote::with('voting', 'calon', 'user')->get();

        return view('admin.home', compact('totalUsers', 'totalCalon', 'totalAdmin', 'detailCalon', 'detailSuara'), ["pemilihan" => Voting::first()]);
    }
}

