<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::guard('admin')->check()) {
            return redirect()->intended('/admin');
        }
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ID_ADMIN' => 'required',
            'PASSWORD_ADMIN' => 'required',
        ], [
            'ID_ADMIN.required' => '*ID Admin tidak boleh kosong',
            'PASSWORD_ADMIN.required' => '*Password tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        $credentials = $request->only('ID_ADMIN', 'PASSWORD_ADMIN');

        $admin = Admin::where('ID_ADMIN', $credentials['ID_ADMIN'])->first();
        if ($admin) {
            if (Auth::guard('admin')->attempt(array('ID_ADMIN' => $credentials['ID_ADMIN'], 'password' => $credentials['PASSWORD_ADMIN']))) {
                $request->session()->regenerate();
                return redirect()->intended('/admin');
            }
            return redirect()->back()->withErrors(['error' => "Password salah !"])->withInput($request->only('ID_ADMIN'));
        }
        return redirect()->back()->withErrors(['error' => "ID tidak terdaftar !"])->withInput($request->only('ID_ADMIN'));
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
