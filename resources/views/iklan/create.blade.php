<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Iklan</p>
        <p class="text-sm">Tambah Data Iklan</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('iklan.store') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="id_client" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Client</label>
                <select id="id_client" name="id_client"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                    <option selected disabled> --- </option>
                    @foreach ($clients as $client)
                        <option value="{{ $client->id_client }}">{{ $client->nama_client }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-5">
                <label for="nama_iklan" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Iklan</label>
                <input type="text" id="nama_iklan" name="nama_iklan"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
            </div>
            <div class="flex gap-2 mb-5">
                <div class="w-1/2">
                    <label for="jumlah_putar" class="block mb-2 text-sm font-medium text-gray-600 ">Jumlah Putar</label>
                    <input type="number" id="jumlah_putar" name="jumlah_putar"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                        required />
                </div>
                <div class="w-1/2">
                    <label for="periode_siar" class="block mb-2 text-sm font-medium text-gray-600 ">Periode Siar</label>
                    <input type="number" id="periode_siar" name="periode_siar"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                        required />
                </div>
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
