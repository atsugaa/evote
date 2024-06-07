<?php
namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Row;
use GuzzleHttp\Middleware;

// User 
Route::get('test', function(){
    return view('test');
});
Route::get('/', [LandingController::class, 'index'])->name('home');
Route::post('login',[LoginController::class,'authenticate'])->name('login');
Route::post('/loginManual',[LoginController::class,'authenticateManual'])->name('loginManual');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('vote', [VoteController::class, 'index'])->name('vote')->middleware('siswa');
Route::get('pilih', [VoteController::class, 'store'])->name('vote')->middleware('siswa');
// Route::post('/login', ['App\Http\Controllers\Auth\AuthController', 'login'])->name('login');

// Admin
Route::get('/generate', ['App\Http\Controllers\TestController', 'generate']);
Route::get('/admin', [ 'App\Http\Controllers\Admin\AdminController' ,'index'])->name('admin.home')->middleware('admin');
Route::get('/admin/login', ['App\Http\Controllers\Auth\AdminAuthController', 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', ['App\Http\Controllers\Auth\AdminAuthController', 'login'])->name('admin.login.submit');
Route::get('/admin/logout', ['App\Http\Controllers\Auth\AdminAuthController', 'logout'])->name('admin.logout')->middleware('admin');
Route::get('/admin/users', ['App\Http\Controllers\Admin\UserController', 'index'])->name('users.index')->middleware('admin');
Route::get('/admin/users/create', ['App\Http\Controllers\Admin\UserController', 'create'])->name('users.create')->middleware('admin');
Route::post('/admin/users/store', ['App\Http\Controllers\Admin\UserController', 'store'])->name('users.store')->middleware('admin');
Route::get('/admin/users/{id}/edit', ['App\Http\Controllers\Admin\UserController', 'edit'])->name('users.edit')->middleware('admin');
Route::put('/admin/users/{id}/update', ['App\Http\Controllers\Admin\UserController', 'update'])->name('users.update')->middleware('admin');
Route::delete('/admin/users/{id}/destroy', ['App\Http\Controllers\Admin\UserController', 'destroy'])->name('users.destroy')->middleware('admin');
Route::get('/admin/calon', ['App\Http\Controllers\Admin\CalonController', 'index'])->name('calon.index')->middleware('admin');
Route::get('/admin/calon/create', ['App\Http\Controllers\Admin\CalonController', 'create'])->name('calon.create')->middleware('admin');
Route::post('/admin/calon/store', ['App\Http\Controllers\Admin\CalonController', 'store'])->name('calon.store')->middleware('admin');
Route::get('/admin/calon/{id}/edit', ['App\Http\Controllers\Admin\CalonController', 'edit'])->name('calon.edit')->middleware('admin');
Route::put('/admin/calon/{id}/update', ['App\Http\Controllers\Admin\CalonController', 'update'])->name('calon.update')->middleware('admin');
Route::delete('/admin/calon/{id}/destroy', ['App\Http\Controllers\Admin\CalonController', 'destroy'])->name('calon.destroy')->middleware('admin');
/*Route::get('/admin/votings', ['App\Http\Controllers\Admin\VotingController', 'index'])->name('votings.index')->middleware('admin');
Route::get('/admin/votings/create', ['App\Http\Controllers\Admin\VotingController', 'create'])->name('votings.create')->middleware('admin');
Route::post('/admin/votings/store', ['App\Http\Controllers\Admin\VotingController', 'store'])->name('votings.store')->middleware('admin');*/
Route::get('/admin/votings/{id}/edit', ['App\Http\Controllers\Admin\VotingController', 'edit'])->name('votings.edit')->middleware('admin');
Route::put('/admin/votings/{id}/update', ['App\Http\Controllers\Admin\VotingController', 'update'])->name('votings.update')->middleware('admin');
/*Route::delete('/admin/votings/{id}/destroy', ['App\Http\Controllers\Admin\VotingController', 'destroy'])->name('votings.destroy')->middleware('admin');*/
Route::post('/users/upload-excel', ['App\Http\Controllers\Admin\UserController', 'uploadExcel'])->name('users.uploadExcel')->middleware('admin');

