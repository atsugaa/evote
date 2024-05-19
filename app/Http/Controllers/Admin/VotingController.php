<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Voting;
use App\Models\Calon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VotingController extends Controller
{
    public function index()
    {
        $votings = Voting::paginate(10);

        foreach ($votings as $voting) {
            $now = Carbon::now();

            if ($now < $voting->MULAI_VOTING) {
                $voting->status = 'Akan Datang';
            }
            elseif ($now >= $voting->MULAI_VOTING && $now <= $voting->SELESAI_VOTING) {
                $voting->status = 'Sedang Berjalan';
            }
            else {
                $voting->status = 'Sudah Berakhir';
            }
        }

        return view('admin.votings.index', compact('votings'));
    }

    public function create()
    {
        $calonList = Calon::all();
        return view('admin.votings.create', compact('calonList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'NAMA_VOTING' => 'required|string|max:255',
            'DESKRIPSI_VOTING' => 'required|string',
            'MULAI_VOTING' => 'required|date',
            'SELESAI_VOTING' => 'required|date|after_or_equal:MULAI_VOTING',
            'candidates' => 'required|array|min:1',
            'candidates.*' => 'exists:calon,ID_CALON',
        ]);

        $lastVoting = Voting::orderBy('ID_VOTING', 'desc')->first();

        if (!$lastVoting) {
            $nextID = 'V0001';
        } else {
            $lastID = substr($lastVoting->ID_VOTING, 1);
            $nextID = 'V' . str_pad($lastID + 1, 4, '0', STR_PAD_LEFT);
        }


        $voting = new Voting();
        $voting->ID_VOTING = $nextID;
        $voting->NAMA_VOTING = $request->NAMA_VOTING;
        $voting->DESKRIPSI_VOTING = $request->DESKRIPSI_VOTING;
        $voting->MULAI_VOTING = $request->MULAI_VOTING;
        $voting->SELESAI_VOTING = $request->SELESAI_VOTING;
        $voting->save();

        $voting->createCalonVotings($request->candidates);

        return redirect()->route('votings.index')->with('success', 'Voting telah berhasil dibuat.');
    }

    public function edit($id)
    {
        $calonList = Calon::all();
        $voting = Voting::findOrFail($id);
        return view('admin.votings.edit', compact('voting'), compact('calonList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'NAMA_VOTING' => 'required|string|max:255',
            'DESKRIPSI_VOTING' => 'required|string',
            'MULAI_VOTING' => 'required|date',
            'SELESAI_VOTING' => 'required|date',
            'candidates' => 'required|array|min:1',
            'candidates.*' => 'exists:calon,ID_CALON',
        ]);

        $voting = Voting::findOrFail($id);
        $voting->update([
            'NAMA_VOTING' => $request->NAMA_VOTING,
            'DESKRIPSI_VOTING' => $request->DESKRIPSI_VOTING,
            'MULAI_VOTING' => $request->MULAI_VOTING,
            'SELESAI_VOTING' => $request->SELESAI_VOTING,
        ]);

        $existingCalonIds = $voting->calonVotings->pluck('ID_CALON')->toArray();

        $selectedCalonIds = $request->candidates;

        $calonToDelete = array_diff($existingCalonIds, $selectedCalonIds);
        foreach ($calonToDelete as $calonId) {
            $voting->calonVotings()->where('ID_CALON', $calonId)->delete();
        }

        $calonToAdd = array_diff($selectedCalonIds, $existingCalonIds);
        foreach ($calonToAdd as $calonId) {
            $voting->calonVotings()->create([
                'ID_CALON' => $calonId
            ]);
        }

        return redirect()->route('votings.edit', 'V0001')
            ->with('success', 'Voting berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $voting = Voting::findOrFail($id);
        $voting->calonVotings()->delete();
        $voting->delete();
        return redirect()->route('votings.index')->with('success', 'Voting berhasil dihapus.');
    }
}