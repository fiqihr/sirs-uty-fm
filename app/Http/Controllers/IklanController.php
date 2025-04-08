<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Iklan;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class IklanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Iklan::query()->orderBy('id_iklan', 'desc'))
                ->addIndexColumn()
                // ->editColumn('id_client', function ($row) {
                //     return 'CLNT-' . $row->id_client;
                // })

                ->editColumn('id_iklan', function ($row) {
                    return 'IKL-' . $row->id_iklan;
                })
                ->editColumn('id_client', function ($row) {
                    return $row->client->nama_client;
                })
                ->addColumn('action', function ($row) {
                    $editBtn = '<a href="' . route('iklan.edit', $row->id_iklan) . '" class="text-yellow-500 px-2 py-1 rounded-md transition-all transition-duration-300 hover:bg-yellow-100 hover:shadow-sm"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_iklan . '" action="' . route('iklan.destroy', $row->id_iklan) . '" method="POST" style="display:inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '
                    <button type="button" onclick="deleteIklan(' . $row->id_iklan . ')" class="text-red-500 px-2 py-1 rounded-md transition-all duration-300 hover:bg-red-100 hover:shadow-sm">
                        <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                    </button>
                </form>';

                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('iklan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = Client::all();
        return view('iklan.create', compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_client' => 'required',
            'nama_iklan' => 'required|string',
            'jumlah_putar' => 'required|integer',
            'periode_siar' => 'required|integer',
        ]);

        $simpan = Iklan::create([
            'id_client' => $request->id_client,
            'nama_iklan' => $request->nama_iklan,
            'jumlah_putar' => $request->jumlah_putar,
            'periode_siar' => $request->periode_siar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($simpan) {
            session()->flash('iklan_berhasil', 'Iklan Berhasil ditambahkan');
            return redirect()->route('iklan.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $clients = Client::all();
        $iklan = Iklan::where('id_iklan', $id)->first();
        return view('iklan.edit', compact('iklan', 'clients'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_client' => 'required',
            'nama_iklan' => 'required|string',
            'jumlah_putar' => 'required|integer',
            'periode_siar' => 'required|integer',
        ]);

        $update = Iklan::where('id_iklan', $id)->update([
            'id_client' => $request->id_client,
            'nama_iklan' => $request->nama_iklan,
            'jumlah_putar' => $request->jumlah_putar,
            'periode_siar' => $request->periode_siar,
            'updated_at' => now(),
        ]);

        if ($update) {
            session()->flash('iklan_berhasil', 'Iklan berhasil diupdate!');
            return redirect()->route('iklan.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = iklan::where('id_iklan', $id)->delete();
        if ($hapus) {
            session()->flash('iklan_berhasil', 'Iklan berhasil dihapus!');
            return redirect()->route('iklan.index');
        } else {
            return redirect()->back();
        }
    }
}
