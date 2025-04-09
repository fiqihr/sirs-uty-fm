<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Edit Program</p>
        <p class="text-sm">Edit Data Program</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('program.update', $program->id_program) }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="nama_program" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Program</label>
                <input type="text" id="nama_program" name="nama_program"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    value="{{ $program->nama_program }}" required />
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit"
                    class="hover:bg-green-200 transition-all transition-duration-300 text-green-500 font-bold py-1 px-3 rounded-md"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
