<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-6 flex justify-between items-end">
        <div class="">
            <p class="font-bold text-4xl">Penyiar</p>
            <p class="text-sm">Data Penyiar</p>
        </div>
        <button onclick="window.location='{{ route('penyiar.create') }}'"
            class="hover:bg-blue-100 transition-all transition-duration-300 text-blue-500 font-bold py-1 px-3 rounded-md"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Penyiar</span>
        </button>
    </div>
    <div class="p-3 bg-gray-50 rounded-md shadow-md">
        <table id="my-table"
            class="rounded-md min-w-full bg-white border-gray-300 text-sm overflow-hidden shadow-sm">
            <thead class=" rounded-t-lg text-gray-200">
                <tr>
                    <th>No</th>
                    <th>ID Penyiar</th>
                    <th>Nama Penyiar</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
        @include('partials.cdn')
        <script>
            const penyiarIndexUrl = "{{ route('penyiar.index') }}";
        </script>
        <script src="{{ asset('pages/penyiar.js') }}"></script>
        @if (session('penyiar_berhasil'))
            <script>
                const penyiarMessage = {!! json_encode(session('penyiar_berhasil')) !!};
                penyiarBerhasil(penyiarMessage);
            </script>
        @endif
</x-sidebar-navbar-layout>
