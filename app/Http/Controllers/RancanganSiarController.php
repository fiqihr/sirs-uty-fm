<?php

namespace App\Http\Controllers;

use App\Http\Requests\CekTanggalRequest;
use App\Models\Client;
use App\Models\Iklan;
use App\Models\Jam;
use App\Models\Memo;
use App\Models\MenuAction;
use App\Models\Penyiar;
use App\Models\RancanganSiar;
use App\Models\Pivot;
use App\Models\PivotMemo;
use App\Models\PivotMenuAction;
use App\Models\Program;
use App\Models\RentangJam;
use App\Models\TanggalRs;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class RancanganSiarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(TanggalRs::query()->orderBy('id_tgl_rs', 'desc'))
                ->addIndexColumn()
                ->editColumn('tanggal', function ($row) {
                    return formatHari($row->tanggal);
                })
                ->filterColumn('tanggal', function ($query, $keyword) {
                    $englishDays = indoToEnglishDay($keyword);
                    $englishMonths = indoToEnglishMonth($keyword);
                    $numeric = trim($keyword); // untuk angka tanggal atau tahun

                    $query->where(function ($q) use ($englishDays, $englishMonths, $numeric) {
                        // filter hari
                        foreach ($englishDays as $day) {
                            $q->orWhereRaw("LOWER(DAYNAME(tanggal)) LIKE ?", ["%" . strtolower($day) . "%"]);
                        }

                        // filter bulan
                        foreach ($englishMonths as $month) {
                            $q->orWhereRaw("LOWER(MONTHNAME(tanggal)) LIKE ?", ["%" . strtolower($month) . "%"]);
                        }

                        // filter tahun (4 digit angka)
                        if (preg_match('/^\d{4}$/', $numeric)) {
                            $q->orWhereYear('tanggal', $numeric);
                        }
                        // filter tanggal (1-31)
                        if (is_numeric($numeric) && (int)$numeric >= 1 && (int)$numeric <= 31) {
                            $q->orWhereDay('tanggal', $numeric);
                        }
                    });
                })
                ->addColumn('action', function ($row) {

                    $showBtn = '<a href="' . route('rancangan-siar.show', $row->id_tgl_rs) . '" class="btn-detail"><i class="fa-solid fa-eye"></i><span class="ml-1 font-bold text-xs">Detail</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_tgl_rs . '" action="' . route('rancangan-siar.destroy', $row->id_tgl_rs) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteRs(' . $row->id_tgl_rs . ')" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';

                    // jika yg login adalah penyiar, maka hanya tampilkan tombol detail
                    if (Auth::user()->hak_akses == 'penyiar') {
                        return $showBtn;
                    } else {
                        // jika bukan penyiar, tampilkan tombol detail dan hapus
                        return $showBtn . $deleteBtn;
                    }
                })
                ->rawColumns(['rentang_jam', 'action'])
                ->toJson();
        }
        return view('rancangan_siar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $iklan = Iklan::all();
        return view('rancangan_siar.create', compact('iklan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data_list = $request->data;
        $all_rancangan_ids = []; // simpan semua id_rs untuk pivot memo nanti

        // loop data rancangan siar
        foreach ($data_list as $baris) {
            $jam = $baris['jam'];
            $iklan_array = $baris['iklan'] ?? [];
            $kuadran_array = $baris['kuadran'] ?? [];

            $count = min(count($iklan_array), count($kuadran_array));

            for ($i = 0; $i < $count; $i++) {
                $simpan_rs = RancanganSiar::create([
                    'id_iklan' => $iklan_array[$i],
                    'id_tgl_rs' => $request->tanggal,
                    'jam' => $jam,
                    'kuadran' => $kuadran_array[$i],
                ]);

                // simpan id_rs untuk dipakai di pivot
                $all_rancangan_ids[] = $simpan_rs->id_rs;
            }
        }

        // simpan memo dan buat relasi ke rancangan_siar (pivot)
        foreach ($request->memo as $memoText) {
            $memo = Memo::create([
                'memo' => $memoText,
                'status' => 'belum', // default sesuai migrasi
            ]);

            // buat relasi ke semua rancangan_siar
            foreach ($all_rancangan_ids as $id_rs) {
                PivotMemo::create([
                    'id_memo' => $memo->id_memo,
                    'id_rs' => $id_rs,
                ]);
            }
        }

        foreach ($request->menu_action as $menuActionText) {
            $menu_action = MenuAction::create([
                'menu_action' => $menuActionText,
                'status' => 'belum', // default sesuai migrasi
            ]);

            // Buat relasi ke semua rancangan_siar
            foreach ($all_rancangan_ids as $id_rs) {
                PivotMenuAction::create([
                    'id_menu_action' => $menu_action->id_menu_action,
                    'id_rs' => $id_rs,
                ]);
            }
        }
        session()->flash('rancangan_siar_berhasil', 'Rancangan Siar berhasil ditambahkan');
        return redirect()->route('rancangan-siar.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // mencari tanggal rancangan siar berdasarkan id
        $tanggal = TanggalRs::findOrFail($id);
        // mencari rancangan siar berdasarkan id_tgl_rs
        $rancangan_siar = RancanganSiar::where('id_tgl_rs', $id)->get();
        // mencari penyiar berdasarkan hak akses
        $penyiars = User::where('hak_akses', 'penyiar')->get();
        // cek jumlah penyiar
        $jumlahPenyiar = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_user')
            ->count('id_user');
        // ambil semua program untuk ditampilkan di dropdown
        $programs = Program::all();
        // cek jumlah program
        $jumlahProgram = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_program')
            ->count('id_program');
        // cek jumlah iklan
        $iklan = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_iklan')
            ->count('id_iklan');

        // pergi ke halaman rancangan siar show
        return view('rancangan_siar.show', compact('tanggal', 'rancangan_siar', 'penyiars', 'programs', 'iklan', 'jumlahPenyiar', 'jumlahProgram'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        RancanganSiar::where('id_tgl_rs', $id)->delete();
        $hapus = TanggalRs::where('id_tgl_rs', $id)->delete();
        if ($hapus) {
            session()->flash('rancangan_siar_berhasil', 'Rancangan Siar berhasil dihapus!');
            return redirect()->route('rancangan-siar.index');
        } else {
            return redirect()->back();
        }
    }

    public function cekTanggal(Request $request)
    {
        // ambil data dari database
        $cekTanggal = TanggalRs::where('tanggal', $request->tanggal)->exists();

        return response()->json(['exists' => $cekTanggal]);
    }

    public function rentangJamRsTraffic($idTglRs, $rentangAwal, $rentangAkhir)
    {
        // mencari rentang jam berdasakan rentang awal dan rentang akhir
        $jamList = RentangJam::whereBetween('id_rentang_jam', [$rentangAwal, $rentangAkhir])
            ->pluck('rentang_jam')
            ->toArray();

        // mencari memo dan menu action rancangan siar berdasarkan id_tgl_rs dan jam
        $rancanganSiar = RancanganSiar::with(['memoPivot.memo', 'menuActionPivot.menu_action'])
            ->where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->get();

        // ambil user yang hak aksesnya penyiar
        $semuaPenyiar = User::where('hak_akses', 'penyiar')->get();
        // ambil semua program
        $semuaProgram = Program::all();
        // mencari tanggal berdasarkan id_tgl_rs
        $tanggal = TanggalRs::where('id_tgl_rs', $idTglRs)->first();
        // 
        $jamAwalFull = RentangJam::find($rentangAwal)?->rentang_jam;
        $jamAkhirFull = RentangJam::find($rentangAkhir)?->rentang_jam;

        // ambil jam awal dan jam akhir dari rentang
        $jamAwal = substr($jamAwalFull, 0, 5);
        $jamAkhir = substr($jamAkhirFull, -5);

        $jamAwalAkhir = "$jamAwal WIB - $jamAkhir WIB";
        // cek penyiar dan program berdasarkan id_tgl_rs
        $cekPenyiarDanProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)->first();

        return view('rancangan_siar.show_jam_traffic', compact('rancanganSiar', 'semuaPenyiar', 'semuaProgram', 'tanggal', 'jamAwalAkhir', 'cekPenyiarDanProgram', 'rentangAwal', 'rentangAkhir'));
    }

    public function rentangJamRs($idTglRs, $rentangAwal, $rentangAkhir)
    {

        $jamList = RentangJam::whereBetween('id_rentang_jam', [$rentangAwal, $rentangAkhir])
            ->pluck('rentang_jam')
            ->toArray();

        $rancanganSiar = RancanganSiar::with(['memoPivot.memo', 'menuActionPivot.menu_action'])
            ->where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->get();

        $semuaPenyiar = User::where('hak_akses', 'penyiar')->get();
        $semuaProgram = Program::all();

        $tanggal = TanggalRs::where('id_tgl_rs', $idTglRs)->first();

        $jamAwalFull = RentangJam::find($rentangAwal)?->rentang_jam;
        $jamAkhirFull = RentangJam::find($rentangAkhir)?->rentang_jam;

        $jamAwal = substr($jamAwalFull, 0, 5);
        $jamAkhir = substr($jamAkhirFull, -5);

        $jamAwalAkhir = "$jamAwal WIB - $jamAkhir WIB";

        $cekPenyiar = RancanganSiar::where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->pluck('id_user')
            ->unique()
            ->toArray();

        $cekProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->pluck('id_program')
            ->unique()
            ->toArray();

        return view('rancangan_siar.show_jam', compact('rancanganSiar', 'semuaPenyiar', 'semuaProgram', 'tanggal', 'jamAwalAkhir', 'cekPenyiar', 'cekProgram'));
    }

    public function simpanMenit(Request $request)
    {
        $statusMemo = $request->status_memo ?? [];
        $statusMenuAction = $request->status_menu_action ?? [];

        // ambil semua id memo yang terkait dengan rancangan_siar
        $idRsList = $request->id_rancangan_siar;
        $relatedMemoIds = collect();
        $relatedMenuActionIds = collect();

        foreach ($idRsList as $idRs) {
            $rs = RancanganSiar::with(['memoPivot.memo', 'menuActionPivot.menu_action'])->find($idRs);

            if ($rs) {
                foreach ($rs->memoPivot as $pivot) {
                    if ($pivot->memo) {
                        $relatedMemoIds->push($pivot->memo->id_memo);
                    }
                }

                foreach ($rs->menuActionPivot as $pivot) {
                    if ($pivot->menu_action) {
                        $relatedMenuActionIds->push($pivot->menu_action->id_menu_action);
                    }
                }
            }
        }

        // hilangkan duplikat ID
        $relatedMemoIds = $relatedMemoIds->unique()->values();
        $relatedMenuActionIds = $relatedMenuActionIds->unique()->values();

        // update memo
        Memo::whereIn('id_memo', $statusMemo)->update(['status' => 'selesai']);
        $uncheckedMemo = $relatedMemoIds->diff($statusMemo);
        Memo::whereIn('id_memo', $uncheckedMemo)->update(['status' => 'belum']);

        // update menu_action
        MenuAction::whereIn('id_menu_action', $statusMenuAction)->update(['status' => 'selesai']);
        $uncheckedMenuAction = $relatedMenuActionIds->diff($statusMenuAction);
        MenuAction::whereIn('id_menu_action', $uncheckedMenuAction)->update(['status' => 'belum']);

        // update Rancangan Siar
        $penyiar = $request->penyiar;
        $program = $request->program;
        $menitPutarList = $request->menit_putar;

        foreach ($idRsList as $index => $idRancanganSiar) {
            RancanganSiar::where('id_rs', $idRancanganSiar)->update([
                'id_user' => $penyiar,
                'id_program' => $program,
                'menit_putar' => $menitPutarList[$index],
            ]);
        }
        session()->flash('rancangan_siar_berhasil', 'Menit Putar berhasil ditambahkan!');
        return redirect()->route('rancangan-siar.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function tambahTanggal(CekTanggalRequest $request)
    {
        $simpan_tanggal = TanggalRs::create([
            'tanggal' => $request->tanggal,
        ]);

        $id_tanggal = $simpan_tanggal->id_tgl_rs;
        return redirect()->route('rancangan-siar.show-create', $id_tanggal);
    }

    public function showCreate(string $id)
    {
        // mencari tanggal rancangan siar berdasarkan id
        $tanggal = TanggalRs::findOrFail($id);
        // mencari rancangan siar berdasarkan id_tgl_rs
        $rancangan_siar = RancanganSiar::where('id_tgl_rs', $id)->get();
        // mencari penyiar berdasarkan hak akses
        $penyiars = User::where('hak_akses', 'penyiar')->get();
        // ambil semua program
        $programs = Program::all();

        return view('rancangan_siar.show_create', compact('tanggal', 'rancangan_siar', 'penyiars', 'programs'));
    }

    public function rentangJamRsCreate($idTglRs, $rentangAwal, $rentangAkhir)
    {

        $jamList = RentangJam::whereBetween('id_rentang_jam', [$rentangAwal, $rentangAkhir])
            ->pluck('rentang_jam')
            ->toArray();
        $rancanganSiar = RancanganSiar::with(['memoPivot.memo', 'menuActionPivot.menu_action'])
            ->where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->get();

        $semuaPenyiar = User::where('hak_akses', 'penyiar')->get();
        $semuaProgram = Program::all();

        $tanggal = TanggalRs::where('id_tgl_rs', $idTglRs)->first();

        $jamAwalFull = RentangJam::find($rentangAwal)?->rentang_jam;
        $jamAkhirFull = RentangJam::find($rentangAkhir)?->rentang_jam;

        $jamAwal = substr($jamAwalFull, 0, 5);
        $jamAkhir = substr($jamAkhirFull, -5);

        $jamAwalAkhir = "$jamAwal WIB - $jamAkhir WIB";

        $cekPenyiar = RancanganSiar::where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->pluck('id_user')
            ->unique()
            ->toArray();

        $cekProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)
            ->whereIn('jam', $jamList)
            ->pluck('id_program')
            ->unique()
            ->toArray();

        $iklan = Iklan::all();
        return view('rancangan_siar.create_rentang_jam', compact('jamList', 'rancanganSiar', 'semuaPenyiar', 'semuaProgram', 'tanggal', 'jamAwalAkhir', 'cekPenyiar', 'cekProgram', 'iklan'));
    }

    public function buatLaporan()
    {
        $clients = Client::all();
        return view('rancangan_siar.buat_laporan', compact('clients'));
    }

    public function cetakLaporan(Request $request)
    {
        $namaIklan = Iklan::where('id_iklan', $request->id_iklan)->first()->nama_iklan;
        $namaClient = Iklan::where('id_iklan', $request->id_client)->first()->client->nama_client;
        $idIklan = Iklan::where('id_iklan', $request->id_iklan)->first()->id_iklan;

        $mulai = $request->periode_siar_mulai;
        $selesai = $request->periode_siar_selesai;
        $idIklan = $request->id_iklan;

        // Ambil id tanggal dari tabel tanggal_rs
        $idTanggalRs = TanggalRs::whereBetween('tanggal', [$mulai, $selesai])
            ->pluck('id_tgl_rs');

        // Ambil semua data dari RancanganSiar yang sesuai
        $rancanganSiar = RancanganSiar::where('id_iklan', $idIklan)
            ->whereIn('id_tgl_rs', $idTanggalRs)
            ->get();

        $jmlPutar = $rancanganSiar->count();

        $pdf = Pdf::loadView('rancangan_siar.cetak_laporan', [
            'rancanganSiar' => $rancanganSiar,
            'jmlPutar' => $jmlPutar,
            'mulai' => $mulai,
            'selesai' => $selesai,
            'namaIklan' => $namaIklan,
            'namaClient' => $namaClient,
            'idIklan' => $idIklan,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan-Rancangan-Siar.pdf');
    }



    public function cekWaktu()
    {
        $now = Carbon::now();
        $today = $now->toDateString();

        $data = RancanganSiar::with('tanggal_rs', 'iklan')
            ->whereHas('tanggal_rs', function ($query) use ($today) {
                $query->whereDate('tanggal', $today);
            })
            ->whereNotNull('menit_putar')
            ->get()
            ->filter(function ($item) use ($now) {
                $playTime = Carbon::createFromFormat('H:i:s', $item->menit_putar);
                return $now->lessThanOrEqualTo($playTime) && $now->diffInMinutes($playTime, false) <= 5;
            })
            ->map(function ($item) {
                $item->formatted_waktu = Carbon::createFromFormat('H:i:s', $item->menit_putar)->format('H:i') . ' WIB';
                return $item;
            })
            ->values();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
    // Tambahkan ini di atas Controller kalau perlu

    public function getTanggalJson(Request $request)
    {
        $term = $request->get('q'); // Keyword pencarian

        // Default ambil maksimal 20 data saja
        $query = TanggalRs::query();

        if ($term) {
            // Kalau inputan user angka tahun, contoh "2025"
            if (is_numeric($term) && strlen($term) == 4) {
                $query->whereYear('tanggal', $term);
            }
            // Kalau inputan user angka bulan, contoh "04" atau "4"
            elseif (is_numeric($term) && (strlen($term) == 1 || strlen($term) == 2) && (int)$term <= 12) {
                $query->whereMonth('tanggal', (int)$term);
            }
            // Kalau inputan huruf (April, Kamis, dst), tetap ambil semua dulu, filter manual
        }

        $results = $query->orderBy('tanggal', 'asc')->take(50)->get(); // Take 50 hasil saja

        $formattedResults = [];

        foreach ($results as $result) {
            $formattedText = formatHari($result->tanggal);

            if (!$term || Str::contains(Str::lower($formattedText), Str::lower($term))) {
                $formattedResults[] = [
                    'id' => $result->id_tgl_rs,
                    'text' => $formattedText,
                ];
            }
        }

        return response()->json($formattedResults);
    }

    public function buatLaporanInternal()
    {
        $bulan = TanggalRs::all()->map(function ($item) {
            return [
                'bulanRaw' => \Carbon\Carbon::parse($item->tanggal)->format('Y-m'),
                'bulan' => formatBulan($item->tanggal), // Gunakan translatedFormat
            ];
        })->unique('bulan')->values();

        // dd($bulan);

        return view('rancangan_siar.buat_laporan_internal', compact('bulan'));
    }

    public function cetakLaporanInternal(Request $request)
    {
        $bulanDipilih = $request->tanggal;

        // Ambil semua id_tgl_rs yang tanggal-nya sesuai dengan bulan dan tahun tersebut
        $idTanggal = TanggalRs::where('tanggal', 'like', $bulanDipilih . '%')
            ->pluck('id_tgl_rs');

        // Ambil semua data rancangan_siar yang id_tgl_rs-nya sesuai
        $dataRancangan = RancanganSiar::with('iklan.client')->whereIn('id_tgl_rs', $idTanggal)->get();

        // Ambil nama iklan dan client secara berpasangan
        $namaIklanClient = $dataRancangan->map(function ($item) {
            return [
                'nama_iklan' => optional($item->iklan)->nama_iklan,
                'nama_client' => optional($item->iklan->client)->nama_client,
            ];
        })->unique(function ($item) {
            return $item['nama_iklan'] . '|' . $item['nama_client'];
        })->values();

        // Tampilkan untuk verifikasi
        // dd([
        //     'bulanDipilih' => $bulanDipilih,
        //     'idTanggal' => $idTanggal,
        //     'dataRancangan' => $dataRancangan,
        //     'iklanClient' => $namaIklanClient,
        // ]);

        $pdf = Pdf::loadView('rancangan_siar.cetak_laporan_internal', [
            'bulanDipilih' => formatBulan($bulanDipilih),
            'idTanggal' => $idTanggal,
            'dataRancangan' => $dataRancangan,
            'iklanClient' => $namaIklanClient,
        ])->setPaper('A4', 'portrait');

        return $pdf->stream('Laporan-Rancangan-Siar-Internal.pdf');
    }
}
