<?php

namespace App\Http\Controllers;

use App\Models\Program;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(Program::query()->orderBy('id_program', 'desc'))
                ->addIndexColumn()
                ->editColumn('id_program', function ($row) {
                    return 'PRG-' . $row->id_program;
                })

                ->addColumn('action', function ($row) {

                    $editBtn = '<a href="' . route('program.edit', $row->id_program) . '" class="btn-edit"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold text-xs">Edit</span></a>';

                    $deleteBtn = '<form id="delete-form-' . $row->id_program . '" action="' . route('program.destroy', $row->id_program) . '" method="POST" style="display:inline;">
                        ' . csrf_field() . '
                        ' . method_field('DELETE') . '
                        <button type="button" onclick="deleteProgram(' . $row->id_program . ')" class="btn-hapus">
                            <i class="fa-solid fa-trash"></i><span class="ml-1 font-bold text-xs">Hapus</span>
                        </button>
                    </form>';
                    return $editBtn . $deleteBtn;
                })
                ->rawColumns(['action'])
                ->toJson();
        }
        return view('program.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('program.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_program' => 'required|string',
        ]);

        $simpan = Program::create([
            'nama_program' => $request->nama_program,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if ($simpan) {
            session()->flash('program_berhasil', 'Program berhasil ditambahkan!');
            return redirect()->route('program.index');
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
        $program = Program::where('id_program', $id)->first();
        return view('program.edit', compact('program'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_program' => 'required|string',
        ]);

        $update = Program::where('id_program', $id)->update([
            'nama_program' => $request->nama_program,
            'updated_at' => now(),
        ]);
        if ($update) {
            session()->flash('program_berhasil', 'program berhasil diupdate!');
            return redirect()->route('program.index');
        } else {
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hapus = Program::where('id_program', $id)->delete();
        if ($hapus) {
            session()->flash('program_berhasil', 'Program berhasil dihapus!');
            return redirect()->route('program.index');
        } else {
            return redirect()->back();
        }
    }
}