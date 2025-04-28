<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex justify-between items-end">
        <div class="flex flex-col gap-2">
            <p class="font-bold text-4xl">Rancangan Siar</p>
            <p class="text-sm italic">Data Rancangan Siar</p>
        </div>
        @php
            $akses = Auth::user()->hak_akses;
        @endphp
        @if ($akses === 'admin' || $akses === 'traffic')
            <button onclick="window.location='{{ route('rancangan-siar.create') }}'" class="btn-tambah"><i
                    class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Rancangan Siar</span>
            </button>
        @elseif($akses === 'admin' || $akses === 'penyiar')
        @endif
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
    <script src="{{ asset('pages/rancangan_siar.js') }}"></script>
    @if (session('rancangan_siar_berhasil'))
        <script>
            const message = {!! json_encode(session('rancangan_siar_berhasil')) !!};
            rancanganSiarBerhasil(message);
        </script>
    @endif

</x-sidebar-navbar-layout>
