<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-6 flex justify-between items-end">
        <div class="">
            <p class="font-bold text-4xl mb-4">Program</p>
            <p class="text-sm">Data Program</p>
        </div>
        <button onclick="window.location='{{ route('program.create') }}'"
            class="btn-tambah"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Program</span>
        </button>
    </div>
    <div class="p-3 bg-gray-50 rounded-md shadow-md">
        <table id="my-table"
            class="rounded-md min-w-full bg-white border-gray-300 text-sm overflow-hidden shadow-sm">
            <thead class=" rounded-t-lg text-gray-200">
                <tr>
                    <th>No</th>
                    <th>ID Program</th>
                    <th>Nama Program</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
        </table>
    </div>
    @include('partials.cdn')
    <script>
        const programIndexUrl = "{{ route('program.index') }}";
    </script>
    <script src="{{ asset('pages/program.js') }}"></script>
    @if (session('program_berhasil'))
        <script>
            const programMessage = {!! json_encode(session('program_berhasil')) !!};
            programBerhasil(programMessage);
        </script>
    @endif
</x-sidebar-navbar-layout>
