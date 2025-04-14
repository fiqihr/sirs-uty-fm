<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-6 flex justify-between items-end">
        <div class="">
            <p class="font-bold text-4xl mb-4">Rancangan Siar</p>
            <p class="text-sm">Data Rancangan Siar</p>
        </div>
        <button onclick="window.location='{{ route('rancangan-siar.create') }}'"
            class="hover:bg-blue-100 transition-all transition-duration-300 text-blue-500 font-bold py-1 px-3 rounded-md"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Rancangan Siar</span>
        </button>
    </div>
    <div class="p-3 bg-gray-50 rounded-md shadow-md">
        <table id="my-table"
            class="rounded-md min-w-full bg-white border border-gray-300 text-sm overflow-hidden shadow-sm">
            <thead class="rounded-t-lg text-gray-200">
                <tr>
                    <th>No</th>
                    <th>Tanggal RS</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>

    @include('partials.cdn')
    <script>
        const rsIndexUrl = "{{ route('rancangan-siar.index') }}";
    </script>
    <script src="{{ asset('pages/rancangan_siar_penyiar.js') }}"></script>

</x-sidebar-navbar-layout>
