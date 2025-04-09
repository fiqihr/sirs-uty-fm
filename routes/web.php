<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\PenyiarController;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dashboard2', function () {
        return view('dashboard2');
    })->name('dashboard2');
    Route::resource('client', ClientController::class);
    Route::resource('iklan', IklanController::class);
    Route::resource('penyiar', PenyiarController::class);
    Route::resource('traffic', TrafficController::class);
    Route::resource('program', ProgramController::class);
});

require __DIR__ . '/auth.php';
