<?php
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\Detailumkm;
use Illuminate\Support\Facades\Route;

use App\Livewire\UmkmList;
use App\Livewire\SearchUmkm;

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
Route::get('/binaan', UmkmList::class)->name('binaan.list');
Route::get('/search-umkm', SearchUmkm::class);

Route::get('/login', Login::class)->name('login');
Route::post('/login', [Login::class, 'login'])->name('login.submit'); // Add this line for POST method
Route::get('/register', Register::class)->name('register');
Route::get('/logout', [Login::class, 'logout'])->name('logout');
Route::get('storage/kml/locations.kml', function () {
    return response()->file(storage_path('app/public/kml/locations.kml'));
});
