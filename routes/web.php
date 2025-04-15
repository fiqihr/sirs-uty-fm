<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\IklanController;
use App\Http\Controllers\PenayanganController;
use App\Http\Controllers\PenyiarController;
use App\Http\Controllers\TrafficController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RancanganSiarController;
use App\Models\Client;
use App\Models\Iklan;
use App\Models\Program;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $jumlahClient = Client::count();
    $jumlahIklan = Iklan::count();
    $jumlahProgram = Program::count();
    return view('dashboard', compact('jumlahClient', 'jumlahIklan', 'jumlahProgram'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/iklan/json', [IklanController::class, 'getIklanJson'])->name('iklan.json');

Route::get('/rancangan-siar/{idTglRs}/{rentangAwal}-{rentangAkhir}', [RancanganSiarController::class, 'rentangJamRs'])->name('rentangJamRs');


Route::resource('rancangan-siar', RancanganSiarController::class);
Route::get('/cek-tanggal', [RancanganSiarController::class, 'cekTanggal'])->name('cek.tanggal');
Route::put('/simpan-menit', [RancanganSiarController::class, 'simpanMenit'])->name('simpan.menit');


// Route::middleware(['auth', 'check.access:admin'])->group(function () {
//     Route::resource('client', ClientController::class);
//     Route::resource('program', ProgramController::class);
// });

Route::middleware(['auth', 'check.access:admin,traffic'])->group(function () {
    Route::resource('traffic', TrafficController::class);
    Route::resource('client', ClientController::class);
    Route::resource('iklan', IklanController::class);

    // iklan json

    // rancangan siar
    Route::get('/rs', function () {
        return view('rs.index');
    })->name('rs.index');
    Route::get('/rs/create', function () {
        $iklan = Iklan::all();
        return view('rs.create', compact('iklan'));
    })->name('rs.create');
});

Route::middleware(['auth', 'check.access:admin,penyiar'])->group(function () {
    // rancangan siar
    // Route::get('/rs', function () {
    //     return view('rs.index');
    // })->name('rs.index');
    // Route::get('/rs/create', function () {
    //     $iklan = Iklan::all();
    //     return view('rs.create', compact('iklan'));
    // })->name('rs.create');
});

Route::middleware(['auth', 'check.access:admin,program_director'])->group(function () {
    Route::resource('penyiar', PenyiarController::class);
    Route::resource('program', ProgramController::class);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/dashboard2', function () {
    //     return view('dashboard2');
    // })->name('dashboard2');
});

require __DIR__ . '/auth.php';
