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
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

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

                // ->editColumn('id_iklan', function ($row) {
                //     return 'IKL-' . $row->id_iklan;
                // })
                // ->editColumn('id_client', function ($row) {
                //     return $row->client->nama_client;
                // })
                // ->editColumn('periode_siar', function ($row) {
                //     return formatTanggal($row->periode_siar_mulai) . ' - ' . formatTanggal($row->periode_siar_selesai);
                // })
                ->addColumn('action', function ($row) {
                    // $editBtn = '<a href="' . route('rancangan-siar.edit', $row->id_rs) . '" class="text-yellow-500 px-2 py-1 rounded-md transition-all transition-duration-300 hover:bg-yellow-100 hover:shadow-sm"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    //     $deleteBtn = '<form id="delete-form-' . $row->id_iklan . '" action="' . route('iklan.destroy', $row->id_iklan) . '" method="POST" style="display:inline;">
                    //     ' . csrf_field() . '
                    //     ' . method_field('DELETE') . '
                    //     <button type="button" onclick="deleteIklan(' . $row->id_iklan . ')" class="text-red-500 px-2 py-1 rounded-md transition-all duration-300 hover:bg-red-100 hover:shadow-sm">
                    //         <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                    //     </button>
                    // </form>';
                    $showBtn = '<a href="' . route('rancangan-siar.show', $row->id_tgl_rs) . '" class="btn-detail"><i class="fa-solid fa-eye"></i><span class="ml-1 font-bold text-xs">Detail</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_tgl_rs . '" action="' . route('rancangan-siar.destroy', $row->id_tgl_rs) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteRs(' . $row->id_tgl_rs . ')" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';

                    return $showBtn . $deleteBtn;
                })
                ->rawColumns(['rentang_jam', 'action'])
                ->toJson();
        }
        return view('rancangan_siar.index_penyiar');
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
        // dd($request->all());
        // Simpan tanggal
        // $simpan_tanggal = TanggalRs::create([
        //     'tanggal' => $request->tanggal,
        // ]);

        $data_list = $request->data;
        $all_rancangan_ids = []; // Simpan semua id_rs untuk pivot memo nanti

        // Loop data rancangan siar
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

                // Simpan id_rs untuk dipakai di pivot
                $all_rancangan_ids[] = $simpan_rs->id_rs;
            }
        }

        // Simpan memo dan buat relasi ke rancangan_siar (pivot)
        foreach ($request->memo as $memoText) {
            $memo = Memo::create([
                'memo' => $memoText,
                'status' => 'belum', // default sesuai migrasi
            ]);

            // Buat relasi ke semua rancangan_siar
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
        return redirect()->route('rancangan-siar.index');




        // --------------------------------------------
        // $simpan_tanggal = TanggalRs::create([
        //     'tanggal' => $request->tanggal,
        // ]);

        // // Ambil data array dari form
        // $data_list = $request->data; // ini akan berupa array dari baris-baris yang berisi jam, iklan[], kuadran[]
        // // dd($data_list);

        // // Loop setiap baris
        // foreach ($data_list as $baris) {
        //     $jam = $baris['jam'];
        //     $iklan_array = $baris['iklan'] ?? [];
        //     $kuadran_array = $baris['kuadran'] ?? [];

        //     // Pastikan jumlah iklan dan kuadran cocok
        //     $count = min(count($iklan_array), count($kuadran_array));

        //     for ($i = 0; $i < $count; $i++) {
        //         $simpan_rs = RancanganSiar::create([
        //             'id_iklan' => $iklan_array[$i],
        //             'id_tgl_rs' => $simpan_tanggal->id_tgl_rs,
        //             'jam' => $jam,
        //             'kuadran' => $kuadran_array[$i],
        //         ]);
        //     }
        // }

        // if ($simpan_tanggal && $simpan_rs) {
        //     // session()->flash('penayangan_berhasil', 'Penayangan Berhasil ditambahkan');
        //     return redirect()->route('rancangan-siar.index');
        // } else {
        //     return redirect()->back();
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tanggal = TanggalRs::findOrFail($id);
        $rancangan_siar = RancanganSiar::where('id_tgl_rs', $id)->get();
        $penyiars = User::where('hak_akses', 'penyiar')->get();
        $jumlahPenyiar = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_user')
            ->count('id_user');
        $programs = Program::all();
        $jumlahProgram = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_program')
            ->count('id_program');
        $iklan = RancanganSiar::where('id_tgl_rs', $id)
            ->distinct('id_iklan')
            ->count('id_iklan');

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
        $hapus = RancanganSiar::where('id_rancangan_siar', $id)->delete();
        if ($hapus) {
            session()->flash('rancangan_siar_berhasil', 'Rancangan Siar berhasil dihapus!');
            return redirect()->route('rancangan-siar.index');
        } else {
            return redirect()->back();
        }
    }

    public function cekTanggal(Request $request)
    {
        $cekTanggal = TanggalRs::where('tanggal', $request->tanggal)->exists();

        return response()->json(['exists' => $cekTanggal]);
    }

    public function rentangJamRsTraffic($idTglRs, $rentangAwal, $rentangAkhir)
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

        // $cekPenyiar = RancanganSiar::where('id_tgl_rs', $idTglRs)
        //     ->whereIn('jam', $jamList)
        //     ->pluck('id_user')
        //     ->unique()
        //     ->toArray();

        $cekPenyiarDanProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)->first();

        // $cekProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)
        //     ->whereIn('jam', $jamList)
        //     ->pluck('id_program')
        //     ->unique()
        //     ->toArray();

        return view('rancangan_siar.show_jam_traffic', compact('rancanganSiar', 'semuaPenyiar', 'semuaProgram', 'tanggal', 'jamAwalAkhir', 'cekPenyiarDanProgram'));
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

        // Ambil semua id memo yang terkait dengan rancangan_siar
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

        // Hilangkan duplikat ID
        $relatedMemoIds = $relatedMemoIds->unique()->values();
        $relatedMenuActionIds = $relatedMenuActionIds->unique()->values();

        // Update memo
        Memo::whereIn('id_memo', $statusMemo)->update(['status' => 'selesai']);
        $uncheckedMemo = $relatedMemoIds->diff($statusMemo);
        Memo::whereIn('id_memo', $uncheckedMemo)->update(['status' => 'belum']);

        // Update menu_action
        MenuAction::whereIn('id_menu_action', $statusMenuAction)->update(['status' => 'selesai']);
        $uncheckedMenuAction = $relatedMenuActionIds->diff($statusMenuAction);
        MenuAction::whereIn('id_menu_action', $uncheckedMenuAction)->update(['status' => 'belum']);

        // Update Rancangan Siar
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
        $tanggal = TanggalRs::findOrFail($id);
        $rancangan_siar = RancanganSiar::where('id_tgl_rs', $id)->get();
        $penyiars = User::where('hak_akses', 'penyiar')->get();
        // $jumlahPenyiar = RancanganSiar::where('id_tgl_rs', $id)
        //     ->distinct('id_user')
        //     ->count('id_user');
        $programs = Program::all();
        // $jumlahProgram = RancanganSiar::where('id_tgl_rs', $id)
        //     ->distinct('id_program')
        //     ->count('id_program');
        // $iklan = RancanganSiar::where('id_tgl_rs', $id)
        //     ->distinct('id_iklan')
        //     ->count('id_iklan');

        return view('rancangan_siar.show_create', compact('tanggal', 'rancangan_siar', 'penyiars', 'programs'));
    }

    public function rentangJamRsCreate($idTglRs, $rentangAwal, $rentangAkhir)
    {
        // dd($idTglRs);

        $jamList = RentangJam::whereBetween('id_rentang_jam', [$rentangAwal, $rentangAkhir])
            ->pluck('rentang_jam')
            ->toArray();
        // dd($jamList);

        // if (count($jamList) == 4) {
        //     dd('4');
        // } else if (count($jamList) > 4) {
        //     dd('5');
        // }

        // $rancanganSiar = RancanganSiar::where('id_tgl_rs', $idTglRs)
        //     ->whereIn('jam', $jamList)
        //     ->get();
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
            // ->whereBetween('id_rs', [$rentangAwal, $rentangAkhir])
            ->whereIn('jam', $jamList)
            ->pluck('id_user')
            ->unique()
            ->toArray();

        $cekProgram = RancanganSiar::where('id_tgl_rs', $idTglRs)
            // ->whereBetween('id_rs', [$rentangAwal, $rentangAkhir])
            ->whereIn('jam', $jamList)
            ->pluck('id_program')
            ->unique()
            ->toArray();

        // foreach ($rancanganSiar as $rs) {
        //     $getMemo = PivotMemo::where('id_rs', $rs->id_rs)->first();
        //     dd($getMemo);
        // }

        // dd($rancanganSiar);
        // $getMemo = PivotMemo::where('id_rs', $rancanganSiar->id_rs)->first();
        // // $getMenuAction = PivotMenuAction::where('id_rs', $id)->get();

        // dd($getMemo);
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
        // $jmlPutar = Iklan::where('id_iklan', $request->id_iklan)->first()->jumlah_putar;
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
            ->values();

        return response()->json([
            'status' => true,
            'data' => $data,
        ]);
    }
}