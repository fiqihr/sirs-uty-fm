<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex flex-col gap-2">
        <p class="font-bold text-4xl mb-2">Menu Rancangan Siar, {{ formatTanggal($tanggal->tanggal) }}</p>
        <p class="text-sm italic">Rancangan Siar &rsaquo; Tambah Tanggal &rsaquo; Menu Rancangan Siar</p>
    </div>
    <div class="container w-full p-8 bg-white rounded-md shadow-md text-gray-600">
        <div class="">
            <div class="mb-4">
                <p class="text-base italic font-bold mb-2 mt-4">&raquo; Hari</p>
                <p class="font-bold text-2xl">{{ formatHari($tanggal->tanggal) }}</p>
            </div>
            <hr class="my-8">
            <p class="text-base italic font-bold mb-2 mt-4">&raquo; Rentang Jam</p>
            <p>Silahkan pilih rentang jam untuk memasukkan iklan dan program pada hari
                {{ formatHari($tanggal->tanggal) }}
            </p>
            <div class="mt-4 grid w-full grid-cols-2 gap-4">
                <a href="{{ route('rentangJamRsCreate', ['idTglRs' => $tanggal->id_tgl_rs, 'rentangAwal' => 1, 'rentangAkhir' => 4]) }}"
                    class="text-center bg-red_1 opacity-70 hover:bg-red_1 hover:opacity-50 transition-all duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">
                    06:00 WIB - 10:00 WIB
                </a>
                <a href="{{ route('rentangJamRsCreate', ['idTglRs' => $tanggal->id_tgl_rs, 'rentangAwal' => 5, 'rentangAkhir' => 9]) }}"
                    class="text-center bg-red_1 opacity-70 hover:bg-red_1 hover:opacity-50 transition-all duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">10:00
                    WIB
                    - 15:00 WIB
                </a>
                <a href="{{ route('rentangJamRsCreate', ['idTglRs' => $tanggal->id_tgl_rs, 'rentangAwal' => 10, 'rentangAkhir' => 14]) }}"
                    class="text-center bg-red_1 opacity-70 hover:bg-red_1 hover:opacity-50 transition-all duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">15:00
                    WIB
                    - 20:00 WIB
                </a>
                <a href="{{ route('rentangJamRsCreate', ['idTglRs' => $tanggal->id_tgl_rs, 'rentangAwal' => 15, 'rentangAkhir' => 19]) }}"
                    class="text-center bg-red_1 opacity-70 hover:bg-red_1 hover:opacity-50 transition-all duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">20:00
                    WIB
                    - 01:00 WIB
                </a>
            </div>
        </div>
    </div>
    @if (session('rancangan_siar_berhasil'))
        <script>
            const message = {!! json_encode(session('rancangan_siar_berhasil')) !!};
            rancanganSiarBerhasil(message);

            function rancanganSiarBerhasil(message) {
                if (message) {
                    Swal.fire({
                        position: "center",
                        icon: "success",
                        text: message,
                        showConfirmButton: false,
                        timer: 1500,
                    });
                }
            }
        </script>
    @endif

</x-sidebar-navbar-layout>
