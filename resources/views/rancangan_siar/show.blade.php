<x-sidebar-navbar-layout>
    @foreach ($rancangan_siar as $item)
        <p>{{ $item->id_rs }}</p>
    @endforeach
</x-sidebar-navbar-layout>
