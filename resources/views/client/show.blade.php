<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Detail Client</p>
        <p class="text-sm italic">Data Client &rsaquo; Detail Client</p>
    </div>
    <div class="container w-full p-8 bg-white rounded-md shadow-md">
        <p class="font-bold text-gray-700 text-3xl mb-2 text-center">{{ $client->nama_client }}</p>
        <p class="text-gray-500 text-base mb-2">Daftar Iklan:</p>
        @if ($client->iklan->isEmpty())
            <p class="text-gray-500 text-base mb-2 text-center italic m-8">Belum ada iklan yang terdaftar.</p>
        @else
            @foreach ($client->iklan as $iklan)
                <div class="flex items-center container w-full rounded-md bg-gray-100 py-4 px-8 mb-3 shadow-md">
                    <div class="w-1/2">
                        <span class="rounded-md text-sm font-bold italic text-secondary px-2 py-1 bg-primary">ID Iklan:
                            IKL-{{ $iklan->id_iklan }}</span>
                        <p class="text-2xl text-gray-600 mt-4 font-bold">{{ $iklan->nama_iklan }}</p>
                    </div>
                    <div class="w-1/2">
                        <p class="text-gray-600 mb-2 italic text-sm">Periode siar:</p>
                        <span
                            class="text-lg bg-white py-2 px-2 font-bold text-gray-600 rounded-lg">{{ formatTanggal($iklan->periode_siar_mulai) }}
                        </span>
                        <span class="text-sm bg-gray-100 mx-2">sampai</span>
                        <span class="text-lg bg-white py-2 px-2 font-bold text-gray-600 rounded-lg">
                            {{ formatTanggal($iklan->periode_siar_selesai) }} </span>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</x-sidebar-navbar-layout>
