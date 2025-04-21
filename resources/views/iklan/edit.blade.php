<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Edit Iklan</p>
        <p class="text-sm">Edit Data Iklan</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('iklan.update', $iklan->id_iklan) }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            @method('PUT')
            <div class="mb-5">
                <label for="nama_iklan" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Iklan</label>
                <input type="text" id="nama_iklan" name="nama_iklan" class="input-form"
                    value="{{ $iklan->nama_iklan }}" required />
            </div>
            <div class="flex gap-2 mb-5">
                <div class="w-1/2">
                    <label for="id_client" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Client</label>
                    <select id="id_client" name="id_client" class="input-form ">
                        <option disabled> --- </option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id_client }}" @if ($client->id_client == $iklan->id_client) selected @endif>
                                {{ $client->nama_client }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="w-1/2">
                    <label for="jumlah_putar" class="block mb-2 text-sm font-medium text-gray-600 ">Jumlah Putar</label>
                    <input type="number" id="jumlah_putar" name="jumlah_putar" class="input-form"
                        value="{{ $iklan->jumlah_putar }}" required />
                </div>
            </div>
            <div class="flex gap-2 mb-5">
                <div class="w-1/2">
                    <label for="periode_siar_mulai" class="block mb-2 text-sm font-medium text-gray-600 ">Mulai Periode
                        Siar</label>
                    <input type="date" id="periode_siar_mulai" name="periode_siar_mulai" class="input-form" required
                        value="{{ $iklan->periode_siar_mulai }}" />
                </div>
                <div class="w-1/2">
                    <label for="periode_siar_selesai" class="block mb-2 text-sm font-medium text-gray-600 ">Selesai
                        Periode Siar</label>
                    <input type="date" id="periode_siar_selesai" name="periode_siar_selesai" class="input-form"
                        required value="{{ $iklan->periode_siar_selesai }}" />
                </div>
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit"
                    class="btn-simpan"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Update</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
