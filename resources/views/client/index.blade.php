<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-6 flex justify-between items-end">
        <div class="">
            <p class="font-bold text-4xl mb-4">Client</p>
            <p class="text-sm">Data Client</p>
        </div>
        <button onclick="window.location='{{ route('client.create') }}'"
            class="btn-tambah"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Client</span>
        </button>
    </div>
    <div class="p-3 bg-gray-50 rounded-md shadow-md">
        <table id="my-table"
            class="rounded-md min-w-full bg-white border-gray-300 text-sm overflow-hidden shadow-sm">
            <thead class=" rounded-t-lg text-gray-200">
                <tr>
                    <th>No</th>
                    <th>ID Client</th>
                    <th>Nama Client</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('partials.cdn')
    <script>
        const clientIndexUrl = "{{ route('client.index') }}";
    </script>
    <script src="{{ asset('pages/client.js') }}"></script>
    @if (session('client_berhasil'))
        <script>
            const clientMessage = {!! json_encode(session('client_berhasil')) !!};
            clientBerhasil(clientMessage);
        </script>
    @endif
</x-sidebar-navbar-layout>
