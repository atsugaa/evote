<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;

class UserController extends Controller {
    public function index(Request $request)
    {
        $status = $request->status;

        $users = User::query();

        if ($status !== null) {
            $users->where('STATUS', $status);
        }

        $users = $users->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function uploadExcel(Request $request)
    {
        $request->validate([
            'excel' => 'required|file|mimes:xls,xlsx|max:10240',
        ]);

        $file = $request->file('excel');

        Excel::import(new UsersImport, $file);

        return redirect()->back()->with('success', 'Data siswa berhasil diunggah dan ditambahkan ke tabel users.');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'NISN' => 'required|unique:users|max:10',
            'NAMA' => 'required|string|max:64',
            'STATUS' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        User::create($request->all());

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'NAMA' => 'required|string|max:64',
            'STATUS' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus.');
    }
}
