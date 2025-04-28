<?php

namespace App\Http\Controllers;

use App\Models\Penyiar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class PenyiarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // return DataTables::of(Penyiar::query()->orderBy('id_penyiar', 'desc'))
            return DataTables::of(User::query()->where('hak_akses', 'penyiar')->orderBy('id', 'desc'))
                ->addIndexColumn()
                // ->editColumn('id_penyiar', function ($row) {
                ->editColumn('id', function ($row) {
                    return 'USR-' . $row->id;
                })

                ->addColumn('action', function ($row) {

                    $editBtn = '<a href="' . route('penyiar.edit', $row->id) . '" class="btn-edit"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id . '" action="' . route('penyiar.destroy', $row->id) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deletePenyiar(' . $row->id . ')" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';

                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('penyiar.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('penyiar.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $simpan = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'hak_akses' => 'penyiar',
        ]);

        if ($simpan) {
            session()->flash('penyiar_berhasil', 'Penyiar berhasil ditambahkan!');
            return redirect()->route('penyiar.index');
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
        $penyiar = User::where('id', $id)->first();
        return view('penyiar.edit', compact('penyiar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
        ]);

        $update = User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        if ($update) {
            session()->flash('penyiar_berhasil', 'Penyiar berhasil diupdate!');
            return redirect()->route('penyiar.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Penyiar::where('id_penyiar', $id)->delete();
        if ($hapus) {
            session()->flash('penyiar_berhasil', 'Penyiar berhasil dihapus!');
            return redirect()->route('penyiar.index');
        } else {
            return redirect()->back();
        }
    }
}
