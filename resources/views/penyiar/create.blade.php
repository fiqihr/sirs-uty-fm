<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Penyiar</p>
        <p class="text-sm italic">Data Penyiar &rsaquo; Tambah Data Penyiar</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('penyiar.store') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-600 ">Nama Penyiar</label>
                <input type="text" id="name" name="name" class="input-form" required />
            </div>
            <div class="mb-5">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-600 ">Email Penyiar</label>
                <input type="email" id="email" name="email" class="input-form" required />
            </div>
            <div class="mb-5">
                <label for="password" class="block mb-2 text-sm font-medium text-gray-600 ">Password Penyiar</label>
                <input type="password" id="password" name="password" class="input-form" required />
            </div>
            <div class="flex justify-end mt-8">
                <button type="submit" class="btn-simpan"><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
