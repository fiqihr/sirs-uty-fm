<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Rancangan Siar</p>
        <p class="text-sm">Detail Rancangan Siar</p>
    </div>
    <div class="container w-full p-8 bg-white rounded-md shadow-md text-gray-600">
        <div class="">
            <div class="mb-4">
                <p class="text-sm">Tanggal</p>
                <p class="font-bold text-2xl">{{ formatHari($tanggal->tanggal) }}</p>
            </div>
            @if (!Auth::user()->hak_akses === 'penyiar')
                <div class="flex gap-2 mb-8">
                    <div
                        class="bg-violet_1 p-8 rounded-md shadow-md w-1/3 flex items-center justify-between text-lg font-bold italic text-white">
                        <span>Program</span> <span>{{ $jumlahProgram }}</span>
                    </div>
                    <div
                        class="bg-violet_2 p-8 rounded-md shadow-md w-1/3 flex items-center justify-between text-lg font-bold italic text-white">
                        <span>Penyiar</span> <span>{{ $jumlahPenyiar }}</span>
                    </div>
                    <div
                        class="bg-orange_1 p-8 rounded-md shadow-md w-1/3 flex items-center justify-between text-lg font-bold italic text-white">
                        <span>Iklan</span> <span>{{ $iklan }}</span>
                    </div>
                </div>
            @endif
            <hr>
            <p class="text-xl font-bold mb-2 mt-4">Rentang Jam</p>
            <p>Silahkan pilih rentang jam untuk melihat iklan dan program pada hari
                {{ formatHari($tanggal->tanggal) }}
            </p>
            @php
                $akses = Auth::user()->hak_akses;
                if ($akses === 'admin' || $akses === 'traffic') {
                    $url1 = route('rentangJamRsTraffic', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 1,
                        'rentangAkhir' => 4,
                    ]);
                    $url2 = route('rentangJamRsTraffic', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 5,
                        'rentangAkhir' => 9,
                    ]);
                    $url3 = route('rentangJamRsTraffic', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 10,
                        'rentangAkhir' => 14,
                    ]);
                    $url4 = route('rentangJamRsTraffic', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 15,
                        'rentangAkhir' => 19,
                    ]);
                } elseif ($akses === 'admin' || $akses === 'penyiar') {
                    $url1 = route('rentangJamRs', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 1,
                        'rentangAkhir' => 4,
                    ]);
                    $url2 = route('rentangJamRs', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 5,
                        'rentangAkhir' => 9,
                    ]);
                    $url3 = route('rentangJamRs', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 10,
                        'rentangAkhir' => 14,
                    ]);
                    $url4 = route('rentangJamRs', [
                        'idTglRs' => $tanggal->id_tgl_rs,
                        'rentangAwal' => 15,
                        'rentangAkhir' => 19,
                    ]);
                } else {
                    $url1 = '#';
                    $url2 = '#';
                    $url3 = '#';
                    $url4 = '#';
                }
            @endphp
            <div class="mt-4 grid w-full grid-cols-2 gap-4">
                <a href="{{ $url1 }}"
                    class="text-center bg-red_1 opacity-70 hover:opacity-50 transition-all transition-duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">
                    06:00 WIB - 10:00 WIB
                </a>
                <a href="{{ $url2 }}"
                    class="text-center bg-red_1 opacity-70 hover:opacity-50 transition-all transition-duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">10:00
                    WIB
                    - 15:00 WIB
                </a>
                <a href="{{ $url3 }}"
                    class="text-center bg-red_1 opacity-70 hover:opacity-50 transition-all transition-duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">15:00
                    WIB
                    - 20:00 WIB
                </a>
                <a href="{{ $url4 }}"
                    class="text-center bg-red_1 opacity-70 hover:opacity-50 transition-all transition-duration-300 text-white font-bold py-4 px-3 rounded-md shadow-md hover:shadow-lg">20:00
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
