<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {

        $request->validate([
            'barcode_data' => 'required',
        ]);

        // dd(explode('/',$request->barcode_data));

        // Decode barcode (Assuming it is in the format NISN_SISWA/NAMA_SISWA)
        $barcode = explode('/', $request->barcode_data);

        if (count($barcode) !== 2) {
            return redirect()->back()->withErrors(['barcode' => 'Invalid barcode format']);
        }

        $nisn_siswa = $barcode[1];
        $nama_siswa = $barcode[0];
        // Check if the Siswa exists
        $siswa = Users::where('NISN', $nisn_siswa)->where('NAMA', $nama_siswa)->first();

        if ($siswa) {

            // Assuming you are using Laravel's default authentication
            Auth::guard('web')->login($siswa);
            
            $request->session()->regenerate();
            return redirect()->intended('vote');
        } else {
            return redirect()->back()->withErrors(['barcode' => 'Invalid barcode or student not found']);
        }

        


    }


    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('home');
    }
}
