<?php
use App\Livewire\EditUmkm;
use App\Livewire\UmkmCrud;
use App\Livewire\UmkmList;
use App\Livewire\Auth\Login;
use App\Livewire\Detailumkm;

use App\Livewire\SearchUmkm;
use App\Livewire\Auth\Register;
use App\Livewire\AssignUmkmUser;
use App\Http\Middleware\CheckAdmin;
use App\Livewire\ManageUmkms;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;

Route::get('/', function () {
    return redirect('/home');
});

Route::get('/debug', function () {
    return view('debug');
})->name('debug');

Route::get('/home', function () {
    return view('welcome');
})->name('home');

Route::get('/binaan/{no_umkm}', DetailUmkm::class)->name('binaan.detail');
Route::get('/binaan/edit/{no_umkm}', EditUmkm::class)->name('binaan.edit');
Route::get('/binaan', UmkmList::class)->name('binaan.list');
Route::get('/search-umkm', SearchUmkm::class);
Route::get('/login', Login::class)->name('login');
Route::post('/login', [Login::class, 'login'])->name('login.submit'); // Add this line for POST method
Route::get('/register', Register::class)->name('register');
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('/umkms', UmkmCrud::class)->name('umkms')->middleware(CheckAdmin::class);
Route::get('/users', ManageUmkms::class)->name('users')->middleware(CheckAdmin::class);
