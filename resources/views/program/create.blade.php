<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Program</p>
        <p class="text-sm italic">Data Program &rsaquo; Tambah Data Program</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('program.store') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="nama_program" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Program</label>
                <input type="text" id="nama_program" name="nama_program" class="input-form" required />
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn-simpan"><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
