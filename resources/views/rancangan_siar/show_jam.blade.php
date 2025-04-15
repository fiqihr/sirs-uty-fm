<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Rentang Jam Rancangan Siar</p>
        <p class="text-sm">Detail Rentang Jam Rancangan Siar</p>
    </div>
    <div class="container w-full p-8 bg-white rounded-md shadow-md text-gray-600">
        <div class="mb-4">
            <p class="text-sm">Tanggal</p>
            <p class="font-bold text-2xl">{{ formatHari($tanggal->tanggal) }}</p>
        </div>
        <div class="p-8 rounded-md bg-gray-200 w-1/2 flex items-center justify-center mb-4 text-xl font-bold">
            {{ $jamAwalAkhir }}
        </div>
        <hr>
        <form action="{{ route('simpan.menit') }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex w-full my-5 gap-4">
                <div class=" w-1/2">
                    <label for="penyiar" class="block mb-2 text-sm font-bold ">Nama Penyiar</label>
                    <select id="penyiar" name="penyiar"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                        <option selected disabled> --- </option>
                        @foreach ($semuaPenyiar as $penyiar)
                            <option value="{{ $penyiar->id }}" @if (in_array($penyiar->id, $cekPenyiar)) selected @endif>
                                {{ $penyiar->name }}
                            </option>

                            {{-- <option value="{{ $penyiar->id }}">{{ $penyiar->name }}</option> --}}
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 w-1/2">
                    <label for="program" class="block mb-2 text-sm font-bold ">Nama Program</label>
                    <select id="program" name="program"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                        <option selected disabled> --- </option>
                        @foreach ($semuaProgram as $program)
                            <option value="{{ $program->id_program }}"
                                @if (in_array($program->id_program, $cekProgram)) selected @endif>
                                {{ $program->nama_program }}
                            </option>
                            {{-- <option value="{{ $program->id_program }}">{{ $program->nama_program }}</option> --}}
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
                        @foreach ($rancanganSiar as $item)
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
                                            <input type="hidden" name="id_rancangan_siar[]"
                                                value="{{ $item->id_rs }}">
                                            <input name="menit_putar[]" type="time"
                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-md focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 @if ($item->menit_putar == null)  @endif"
                                                value="{{ $item->menit_putar ?? null }}" required
                                                oninput="validity.valid || (value = '')">
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <hr class="mt-8">
            <div class="row flex gap-4 mt-8 my-4">
                <div class="w-2/3">
                    <label for="message" class=" text-sm font-medium">Memo</label>
                    <textarea id="message" rows="4"
                        class="mt-2 p-2.5 w-full text-sm  bg-gray-50 rounded-md border border-gray-300 focus:ring-gray-500 focus:border-gray-500  "
                        placeholder="Memo..."></textarea>
                </div>
                <div class="w-1/3">
                    <label for="menu-action" class=" text-sm font-medium ">Menu Action</label>
                    <textarea id="menu-action" rows="4"
                        class="mt-2 p-2.5 w-full text-sm  bg-gray-50 rounded-md border border-gray-300 focus:ring-gray-500 focus:border-gray-500  "
                        placeholder="Menu Action/Acara..."></textarea>
                </div>
            </div>

            {{-- <div class="w-1-3">
                    <label for="menu-action"></label>
                </div> --}}
            <div class="flex justify-end mt-5">
                <button type="submit" id="btn-submit"
                    class=" transition-all transition-duration-300  font-bold py-1 px-3 rounded-md {{ $rancanganSiar->isEmpty() ? 'hover:bg-gray-200  cursor-not-allowed' : 'hover:bg-green-200 text-green-500' }}"
                    {{ $rancanganSiar->isEmpty() ? 'disabled' : '' }}><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>

</x-sidebar-navbar-layout>
