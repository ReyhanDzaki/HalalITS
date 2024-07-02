<?php

use App\Livewire\Detailumkm;
use App\Livewire\UmkmList; // Add this line to import the missing class

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenticate'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'authenicate'])->name('login');


Route::get('/binaan/{no_umkm}', DetailUmkm::class)->name('binaan.detail');
Route::get('/binaan', UmkmList::class)->name('binaan.list');
