<?php

use Illuminate\Support\Facades\Route;

Route::get('/', ['App\Http\Controllers\LandingController', 'index'])->name('home');
Route::post('/login', ['App\Http\Controllers\Auth\AuthController', 'login'])->name('login');
Route::get('/generate', ['App\Http\Controllers\TestController', 'generate']);
Route::get('/admin', ['App\Http\Controllers\Admin\AdminController', 'index'])->name('admin.home')->middleware('admin');
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

