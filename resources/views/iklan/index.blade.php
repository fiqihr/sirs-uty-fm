<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex justify-between items-end ">
        <div class="flex flex-col gap-2">
            <p class="font-bold text-4xl">Iklan</p>
            <p class="text-sm italic">Data Iklan </p>
        </div>
        <button onclick="window.location='{{ route('iklan.create') }}'" class="btn-tambah"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Iklan</span>
        </button>
    </div>
    <div class="p-3 bg-gray-50 rounded-md shadow-md">
        <table id="my-table"
            class="rounded-md min-w-full bg-white border border-gray-300 text-sm overflow-hidden shadow-sm">
            <thead class="rounded-t-lg text-gray-200">
                <tr>
                    <th>No</th>
                    <th>ID Iklan</th>
                    <th>Nama Client</th>
                    <th>Nama Iklan</th>
                    <th>Jumlah Putar</th>
                    <th>Periode Siar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('partials.cdn')
    <script>
        const iklanIndexUrl = "{{ route('iklan.index') }}";
    </script>
    <script src="{{ asset('pages/iklan.js') }}"></script>
    <script>
        const iklanMessage = {!! json_encode(session('iklan_berhasil')) !!};
        iklanBerhasil(iklanMessage);
    </script>
</x-sidebar-navbar-layout>
