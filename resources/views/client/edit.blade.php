<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Edit Client</p>
        <p class="text-sm">Edit Data Client</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('client.update', $client->id_client) }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="nama_client" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Client</label>
                <input type="text" id="nama_client" name="nama_client"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-3"
                    value="{{ $client->nama_client }}" required />
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit"
                    class="hover:bg-emerald-100 transition-all transition-duration-300 text-emerald-600 font-bold py-2 px-4 rounded-full"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
