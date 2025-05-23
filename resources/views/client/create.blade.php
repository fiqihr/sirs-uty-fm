<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Client</p>
        <p class="text-sm italic">Data Client &rsaquo; Tambah Data Client</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('client.store') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="nama_client" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Client</label>
                <input type="text" id="nama_client" name="nama_client" class="input-form" required />
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn-simpan"><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
