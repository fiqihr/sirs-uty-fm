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
        {{-- <div class="">
            <div class="mb-4">
                <p class="text-sm">Tanggal</p>
                <p class="font-bold text-2xl">{{ formatHari($tanggal->tanggal) }}</p>
            </div>
            <hr>
            <div class="flex w-full my-5 gap-4">
                <div class=" w-1/2">
                    <label for="penyiar" class="block mb-2 text-sm font-bold ">Nama Penyiar</label>
                    <select id="penyiar" name="penyiar"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                        <option selected disabled> --- </option>
                        @foreach ($penyiars as $penyiar)
                            <option value="{{ $penyiar->id }}">{{ $penyiar->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 w-1/2">
                    <label for="program" class="block mb-2 text-sm font-bold ">Nama Program</label>
                    <select id="program" name="program"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                        <option selected disabled> --- </option>
                        @foreach ($programs as $program)
                            <option value="{{ $program->id_program }}">{{ $program->nama_program }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-md">
                <table
                    class="w-full text-sm text-left rtl:text-right text-gray-500 overflow-hidden shadow-md tablebord">
                    <thead class="text-xs text-gray-600 uppercase bg-gray-100  ">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                Jam
                            </th>
                            <th scope="col" class="text-center py-3">
                                Iklan & Kuadran
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($rancangan_siar as $item)
                            <tr class="odd:bg-white even:bg-gray-50">
                                <td class="px-6 py-4">{{ $item->jam }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-evenly">
                                        <p>
                                            Iklan: <span class="font-bold">{{ $item->iklan->nama_iklan }}</span>
                                        </p>
                                        <p>
                                            Kuadran: <span class="font-bold">{{ $item->kuadran }}</span>
                                        </p>
                                        <div class="flex items-center gap-2">
                                            <label for="menit_putar">Menit:</label>
                                            <input name="menit_putar" type="time"
                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5">
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="flex justify-end mt-5">
                <button type="submit" id="btn-submit"
                    class="hover:bg-green-200 transition-all transition-duration-300 text-green-500 font-bold py-1 px-3 rounded-md"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </div> --}}
    </div>

</x-sidebar-navbar-layout>
