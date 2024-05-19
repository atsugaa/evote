<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $totalUsers = DB::table('users')->count();
        $totalCalon = DB::table('calon')->count();
        $totalAdmin = DB::table('admin')->count();

        return view('admin.home', compact('totalUsers', 'totalCalon', 'totalAdmin'));
    }
}
