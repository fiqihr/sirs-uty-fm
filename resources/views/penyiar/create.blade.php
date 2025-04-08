<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Penyiar</p>
        <p class="text-sm">Tambah Data Penyiar</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('penyiar.store') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="nama_penyiar" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Penyiar</label>
                <input type="text" id="nama_penyiar" name="nama_penyiar"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
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
