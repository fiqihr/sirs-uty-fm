<?php

namespace App\Http\Controllers;

use App\Http\Requests\CekTanggalRequest;
use App\Models\Iklan;
use App\Models\Jam;
use App\Models\RancanganSiar;
use App\Models\Pivot;
use App\Models\TanggalRs;
use Illuminate\Http\Request;
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
                    $showBtn = '<a href="' . route('rancangan-siar.show', $row->id_tgl_rs) . '" class=" text-blue-400 px-2 py-1 rounded-md transition-all transition-duration-300 hover:bg-blue-100 hover:shadow-sm"><i class="fa-solid fa-eye"></i><span class="ml-1 font-bold text-xs">Detail</span></a>';

                    $deleteBtn = '<button type="button" class=" text-red-500 px-2 py-1 rounded-md transition-all duration-300 hover:bg-red-100 hover:shadow-sm">
                        <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                    </button>
                </form>';

                    return $showBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
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
    public function store(CekTanggalRequest $request)
    {
        $simpan_tanggal = TanggalRs::create([
            'tanggal' => $request->tanggal,
        ]);

        $simpan_rs = RancanganSiar::create([
            'id_iklan' => $request->id_iklan,
            'id_tgl_rs' => $simpan_tanggal->id_tgl_rs,
            'jam' => $request->jam,
            'kuadran' => $request->kuadran,
        ]);


        // $simpan_pivot = Pivot::create([
        //     'id_penayangan' => $simpan_penayangan->id_penayangan,
        //     'id_tanggal_rs' => $simpan_tanggal->id_tanggal_rs,
        // ]);

        // dd($simpan_penayangan);
        // dd($simpan_tanggal);
        // dd($simpan_pivot);

        if ($simpan_tanggal && $simpan_rs) {
            // session()->flash('penayangan_berhasil', 'Penayangan Berhasil ditambahkan');
            return redirect()->route('rancangan-siar.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tanggal = TanggalRs::findOrFail($id);
        $rancangan_siar = RancanganSiar::where('id_tgl_rs', $id)->get();
        return view('rancangan_siar.show', compact('tanggal', 'rancangan_siar'));
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
        //
    }

    public function cekTanggal(Request $request)
    {
        $cekTanggal = TanggalRs::where('tanggal', $request->tanggal)->exists();

        return response()->json(['exists' => $cekTanggal]);
    }
}