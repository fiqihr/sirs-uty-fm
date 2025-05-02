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
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\App;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    $jumlahClient = Client::count();
    $jumlahIklan = Iklan::count();
    $jumlahProgram = Program::count();
    $jumlahRs = RancanganSiar::count();
    $jumlahPenyiar = User::where('hak_akses', 'penyiar')->count();
    App::setLocale('id');
    $dataChart = Iklan::selectRaw("DATE_FORMAT(periode_siar_mulai, '%Y-%m') as bulan, COUNT(*) as jumlah")
        ->whereYear('periode_siar_mulai', 2025) // filter tahun jika perlu
        ->groupBy('bulan')
        ->pluck('jumlah', 'bulan'); // hasil: ['2025-04' => 5, '2025-05' => 1]

    // Generate semua bulan di tahun 2025
    $chartData = collect(CarbonPeriod::create('2025-01-01', '1 month', '2025-12-01'))
        ->map(function ($date) use ($dataChart) {
            $bulanKey = $date->format('Y-m');
            return [
                'x' => $date->translatedFormat('F'),
                'y' => $dataChart[$bulanKey] ?? 0, // isi 0 kalau tidak ada data
            ];
        });
    return view('dashboard', compact('jumlahClient', 'jumlahIklan', 'jumlahProgram', 'jumlahRs', 'jumlahPenyiar', 'chartData'));
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
    Route::get('/laporan-internal', [RancanganSiarController::class, 'buatLaporanInternal'])->name('buatLaporanInternal');
    Route::post('/laporan-internal/cetak/', [RancanganSiarController::class, 'cetakLaporanInternal'])->name('cetakLaporanInternal');
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
