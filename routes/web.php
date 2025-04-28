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
use App\Models\RancanganSiar;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $jumlahClient = Client::count();
    $jumlahIklan = Iklan::count();
    $jumlahProgram = Program::count();
    $jumlahRs = RancanganSiar::count();
    $jumlahPenyiar = User::where('hak_akses', 'penyiar')->count();
    return view('dashboard', compact('jumlahClient', 'jumlahIklan', 'jumlahProgram', 'jumlahRs', 'jumlahPenyiar'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard/penyiar', function () {
    return view('dashboard_penyiar');
})->middleware(['auth', 'verified'])->name('dashboard.penyiar');

Route::get('/get-tanggal-json', [RancanganSiarController::class, 'getTanggalJson'])->name('get.tanggal.json');

Route::get('/iklan/json', [IklanController::class, 'getIklanJson'])->name('iklan.json');
Route::get('/cek-tanggal', [RancanganSiarController::class, 'cekTanggal'])->name('cek.tanggal');
Route::put('/simpan-menit', [RancanganSiarController::class, 'simpanMenit'])->name('simpan.menit');
Route::get('/get-iklan-by-client/{id_client}', [IklanController::class, 'getIklanByClient'])->name('get-iklan-by-client');
Route::get('/cek-waktu', [RancanganSiarController::class, 'cekWaktu']);


Route::middleware(['auth', 'check.access:admin,traffic'])->group(function () {
    Route::resource('traffic', TrafficController::class);
    Route::resource('client', ClientController::class);
    Route::resource('iklan', IklanController::class);
    Route::get('/rancangan-siar/create', [RancanganSiarController::class, 'create'])->name('rancangan-siar.create');
    Route::post('/rancangan-siar', [RancanganSiarController::class, 'store'])->name('rancangan-siar.store');
    Route::delete('/rancangan-siar/{id}', [RancanganSiarController::class, 'destroy'])->name('rancangan-siar.destroy');
    Route::post('/rancangan-siar/tambah-tanggal', [RancanganSiarController::class, 'tambahTanggal'])->name('tambah.tanggal');
    Route::get('/rancangan-siar/show-create/{id}', [RancanganSiarController::class, 'showCreate'])->name('rancangan-siar.show-create');
    Route::get('/rancangan-siar/show-create/{idTglRs}/{rentangAwal}-{rentangAkhir}', [RancanganSiarController::class, 'rentangJamRsCreate'])->name('rentangJamRsCreate');
    Route::get('/rancangan-siar/traffic/{idTglRs}/{rentangAwal}-{rentangAkhir}', [RancanganSiarController::class, 'rentangJamRsTraffic'])->name('rentangJamRsTraffic');
    Route::get('/laporan', [RancanganSiarController::class, 'buatLaporan'])->name('buatLaporan');
    Route::post('/laporan/cetak', [RancanganSiarController::class, 'cetakLaporan'])->name('cetakLaporan');
});

Route::middleware(['auth', 'check.access:admin,penyiar'])->group(function () {
    Route::get('/rancangan-siar/{idTglRs}/{rentangAwal}-{rentangAkhir}', [RancanganSiarController::class, 'rentangJamRs'])->name('rentangJamRs');
});

Route::middleware(['auth', 'check.access:admin,penyiar,traffic'])->group(function () {
    Route::get('/rancangan-siar', [RancanganSiarController::class, 'index'])->name('rancangan-siar.index');
    Route::get('/rancangan-siar/{id}', [RancanganSiarController::class, 'show'])->name('rancangan-siar.show');
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