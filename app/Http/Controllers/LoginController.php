<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Vote;

class LoginController extends Controller
{

    private function cekSiswa($request,$nisn,$nama){

        $siswa = Users::where('NISN', $nisn)->where('NAMA', $nama)->first();
        $vote = Vote::where("NISN",$nisn)->first();

        if ($siswa && !$vote) {
            Auth::guard('web')->login($siswa);
            $request->session()->regenerate();
            return redirect()->intended('vote');
        } else {
            return redirect()->back()->withErrors(['barcode_error' => 'Barcode/Nama & NISN Salah']);
        }

    }
    public function authenticate(Request $request)
    {
        
        $request->validate([
            'barcode_data' => "required|min:13|max:50",
        ]);
        $barcode = explode('/', $request->barcode_data);
        if (count($barcode) !== 2) {
            return redirect()->back()->withErrors(['barcode_error' => 'Format Tidak Sesuai']);
        }

        $nisn_siswa = $barcode[1];
        $nama_siswa = $barcode[0];

        return $this->cekSiswa($request,$nisn_siswa,$nama_siswa);

        return redirect()->back()->withErrors(['barcode_error' => 'Format Tidak Sesuai']);
        
    }
    
    public function authenticateManual(Request $request){
        
        $credentials = $request->validate([
            'nama' => "required|min:3|max:50",
            'nisn' => "required|min:10|max:10"
        ]);

        if($credentials){
            return $this->cekSiswa($request ,$request->nisn,$request->nama);
        }

        return redirect()->back()->withErrors(['barcode_error' => 'Format Tidak Sesuai']);

    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
