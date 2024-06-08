<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Calon;
use App\Models\Voting;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;

class VoteController extends Controller
{
    public function index()
    {
        return view('user.vote',["Calons"=> Calon::all()]);
    }

    public function store(Request $request)
    {
        $id_vote = Voting::first()["ID_VOTING"];
       
        $lastVoting = Vote::orderBy('ID_VOTE', 'desc')->first();
        

        if (! $lastVoting) {
            $nextID = 'X0001';
        } else {
            $lastID = (int)substr($lastVoting->getAttributes()['ID_VOTE'], 1);
            
            $nextID = 'X' . str_pad($lastID + 1, 4, '0', STR_PAD_LEFT);
        }

        Vote::create([
            "ID_VOTE" => $nextID,
            "ID_CALON" => $request->calon,
            "ID_VOTING" =>$id_vote,
            "NISN" =>$request->user
        ]);

        Auth::guard('web')->logout();
        return redirect()->route('home');

    }


}
