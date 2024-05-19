<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Calon;

class CalonController extends Controller
{
    public function index()
    {
        $calon = Calon::paginate(10);
        return view('admin.calon.index', compact('calon'));
    }

    public function create()
    {
        return view('admin.calon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'KETUA_CALON' => 'required',
            'WAKIL_CALON' => 'required',
            'VISI_CALON' => 'required',
            'MISI_CALON' => 'required',
            'GAMBAR_CALON' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $lastCalon = Calon::orderBy('ID_CALON', 'desc')->first();

        if (!$lastCalon) {
            $nextID = 'C0001';
        } else {
            $lastID = substr($lastCalon->ID_CALON, 1);
            $nextID = 'C' . str_pad($lastID + 1, 4, '0', STR_PAD_LEFT);
        }

        $imageName = $nextID . '_' . time() . '.' . $request->file('GAMBAR_CALON')->getClientOriginalExtension();
        $request->file('GAMBAR_CALON')->storeAs('images', $imageName, 'public');

        $calon = new Calon();
        $calon->ID_CALON = $nextID;
        $calon->KETUA_CALON = $request->KETUA_CALON;
        $calon->WAKIL_CALON = $request->WAKIL_CALON;
        $calon->VISI_CALON = $request->VISI_CALON;
        $calon->MISI_CALON = $request->MISI_CALON;
        $calon->GAMBAR_CALON = $imageName;
        $calon->save();

        return redirect()->route('calon.index')->with('success', 'Calon berhasil ditambahkan');
    }

    public function edit($id)
    {
        $calon = Calon::findOrFail($id);
        return view('admin.calon.edit', compact('calon'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'KETUA_CALON' => 'required',
            'WAKIL_CALON' => 'required',
            'VISI_CALON' => 'required',
            'MISI_CALON' => 'required',
            'GAMBAR_CALON' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $calon = Calon::findOrFail($id);

        $calon->KETUA_CALON = $request->KETUA_CALON;
        $calon->WAKIL_CALON = $request->WAKIL_CALON;
        $calon->VISI_CALON = $request->VISI_CALON;
        $calon->MISI_CALON = $request->MISI_CALON;
        $calon->save();

        if ($request->hasFile('GAMBAR_CALON')) {
            if ($calon->GAMBAR_CALON) {
                Storage::disk('public')->delete('images/' . $calon->GAMBAR_CALON);
            }

            $imageName = $calon->ID_CALON . '_' . time() . '.' . $request->file('GAMBAR_CALON')->getClientOriginalExtension();
            $request->file('GAMBAR_CALON')->storeAs('images', $imageName, 'public');
            $calon->GAMBAR_CALON = $imageName;
            $calon->save();
        }

        return redirect()->route('calon.index')->with('success', 'Calon berhasil diperbarui');
    }

    public function destroy($id)
    {
        $calon = Calon::findOrFail($id);
        $calon->delete();
        if ($calon->GAMBAR_CALON) {
            Storage::disk('public')->delete('images/' . $calon->GAMBAR_CALON);
        }
        return redirect()->route('calon.index')->with('success', 'Calon berhasil dihapus.');
    }
}