<?php

namespace App\Http\Controllers;

use App\Models\Traffic;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TrafficController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Traffic::query()->orderBy('id_traffic', 'desc'))
                ->addIndexColumn()
                ->editColumn('id_traffic', function ($row) {
                    return 'TFC-' . $row->id_traffic;
                })

                ->addColumn('action', function ($row) {

                    $editBtn = '<a href="' . route('traffic.edit', $row->id_traffic) . '" class="text-yellow-500 px-2 py-1 rounded-md transition-all transition-duration-300 hover:bg-yellow-100 hover:shadow-sm"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_traffic . '" action="' . route('traffic.destroy', $row->id_traffic) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteTraffic(' . $row->id_traffic . ')" class="text-red-500 px-2 py-1 rounded-md transition-all duration-300 hover:bg-red-100 hover:shadow-sm">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('traffic.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('traffic.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_traffic' => 'required|string',
        ]);

        $simpan = Traffic::create([
            'nama_traffic' => $request->nama_traffic,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($simpan) {
            session()->flash('traffic_berhasil', 'Traffic berhasil ditambahkan!');
            return redirect()->route('traffic.index');
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
        $traffic = Traffic::where('id_traffic', $id)->first();
        return view('traffic.edit', compact('traffic'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_traffic' => 'required|string',
        ]);

        $update = Traffic::where('id_traffic', $id)->update([
            'nama_traffic' => $request->nama_traffic,
            'updated_at' => now(),
        ]);
        if ($update) {
            session()->flash('traffic_berhasil', 'Traffic berhasil diupdate!');
            return redirect()->route('traffic.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Traffic::where('id_traffic', $id)->delete();
        if ($hapus) {
            session()->flash('traffic_berhasil', 'Traffic berhasil dihapus!');
            return redirect()->route('traffic.index');
        } else {
            return redirect()->back();
        }
    }
}