<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-6 flex justify-between items-end">
        <div class="">
            <p class="font-bold text-4xl mb-4">Rancangan Siar</p>
            <p class="text-sm">Data Rancangan Siar</p>
        </div>
        <button onclick="window.location='{{ route('rs.create') }}'"
            class="hover:bg-blue-100 transition-all transition-duration-300 text-blue-500 font-bold py-1 px-3 rounded-md"><i
                class="fa-solid fa-plus"></i><span class="ml-1 font-bold">Tambah Rancangan Siar</span>
        </button>
    </div>

    @include('partials.cdn')

</x-sidebar-navbar-layout>
