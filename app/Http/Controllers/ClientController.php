<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Client::query()->orderBy('id_client', 'desc'))
                ->addIndexColumn()
                ->editColumn('id_client', function ($row) {
                    return 'CLNT-' . $row->id_client;
                })

                ->addColumn('action', function ($row) {
                    $showBtn = '<a href="' . route('client.show', $row->id_client) . '" class="btn-detail"><i class="fa-solid fa-eye"></i><span class="ml-1 font-bold text-xs">Detail</span></a>';

                    $editBtn = '<a href="' . route('client.edit', $row->id_client) . '" class="btn-edit"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_client . '" action="' . route('client.destroy', $row->id_client) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteClient(' . $row->id_client . ')" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';



                    return $showBtn . $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('client.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('client.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_client' => 'required|string',
        ]);

        $simpan = Client::create([
            'nama_client' => $request->nama_client,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($simpan) {
            session()->flash('client_berhasil', 'Client berhasil ditambahkan!');
            return redirect()->route('client.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $client = Client::with('iklan')->where('id_client', $id)->first();
        if ($client) {
            return view('client.show', compact('client'));
        } else {
            return redirect()->back();
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $client = Client::where('id_client', $id)->first();
        return view('client.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_client' => 'required|string',
        ]);

        $update = Client::where('id_client', $id)->update([
            'nama_client' => $request->nama_client,
            'updated_at' => now(),
        ]);
        if ($update) {
            session()->flash('client_berhasil', 'Client berhasil diupdate!');
            return redirect()->route('client.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Client::where('id_client', $id)->delete();
        if ($hapus) {
            session()->flash('client_berhasil', 'Client berhasil dihapus!');
            return redirect()->route('client.index');
        } else {
            return redirect()->back();
        }
    }
}