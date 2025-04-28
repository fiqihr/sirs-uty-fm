<x-sidebar-navbar-layout>
    <div class="flex justify-between">
        <div class="text-gray-600 mb-8 flex flex-col gap-2">
            <p class="font-bold text-4xl mb-2">Rentang Jam Rancangan Siar Traffic</p>
            <p class="text-sm italic">Rancangan Siar &rsaquo; Detail &rsaquo; Rentang Jam Rancangan Siar</p>
        </div>
        {{-- <p>{{ $tanggal->id_tgl_rs }}</p>
        <p>{{ $rentangAwal }}</p>
        <p>{{ $rentangAkhir }}</p> --}}
        <div class="flex items-center">
            <button
                onclick="window.location='{{ route('rentangJamRsCreate', ['idTglRs' => $tanggal->id_tgl_rs, 'rentangAwal' => $rentangAwal, 'rentangAkhir' => $rentangAkhir]) }}'"
                class="btn-edit"><i class="fa-solid fa-pen-nib"></i><span class="ml-1 font-bold">Edit Rancangan Siar</span>
            </button>
        </div>
    </div>
    <div class="container w-full p-8 bg-white rounded-md shadow-md text-gray-600">
        <div class="mb-4">
            <p class="text-base italic font-bold mb-2 mt-4">&raquo; Hari, Tanggal</p>
            <p class="font-bold text-2xl">{{ formatHari($tanggal->tanggal) }}</p>
        </div>
        <div
            class="p-8 bg-red_1 opacity-70 transition-all duration-300 text-white font-bold w-1/2 flex items-center justify-center my-4 text-xl rounded-lg shadow-md hover:shadow-lg">
            {{ $jamAwalAkhir }}
        </div>
        <hr class="my-8">
        <div class="flex w-full my-5 gap-4">
            <div class=" w-1/2">
                <p class="block mb-2 text-base font-bold italic ">&raquo; Nama Penyiar</p>
                <p>{{ $cekPenyiarDanProgram->user->name ?? 'Belum ada' }}</p>
            </div>
            <div class="mb-5 w-1/2">
                <p class="block mb-2 text-base font-bold italic ">&raquo; Nama Program</p>
                <p>{{ $cekPenyiarDanProgram->program->nama_program ?? 'Belum ada' }}</p>
            </div>
        </div>
        <div class="relative overflow-x-auto shadow-md sm:rounded-md">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 overflow-hidden shadow-md tablebord">
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
                                <div class="flex items-center ">
                                    <p class="w-1/3">
                                        Iklan: <span class="font-bold">{{ $item->iklan->nama_iklan }}</span>
                                    </p>
                                    <p class="w-1/3">
                                        Kuadran: <span class="font-bold">{{ $item->kuadran }}</span>
                                    </p>
                                    <div class="flex items-center gap-2 w-1/3">
                                        <p>Jam:menit :</p>
                                        <p class="font-bold">{{ formatMenit($item->menit_putar) }} WIB</p>
                                    </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <hr class="mt-8">
        @php
            $semuaMemo = collect();
            foreach ($rancanganSiar as $rs) {
                foreach ($rs->memoPivot as $pivot) {
                    if ($pivot->memo) {
                        $semuaMemo->push([
                            'id_memo' => $pivot->memo->id_memo,
                            'memo' => $pivot->memo->memo,
                            'status' => $pivot->memo->status,
                        ]);
                    }
                }
            }
            $semuaMenuAction = collect();
            foreach ($rancanganSiar as $rs) {
                foreach ($rs->menuActionPivot as $pivot) {
                    if ($pivot->menu_action) {
                        $semuaMenuAction->push([
                            'id_menu_action' => $pivot->menu_action->id_menu_action,
                            'menu_action' => $pivot->menu_action->menu_action,
                            'status' => $pivot->menu_action->status,
                        ]);
                    }
                }
            }
            // Filter duplikat berdasarkan id_memo
            $uniqueMemo = $semuaMemo->unique('id_memo')->values();
            $uniqueMenuAction = $semuaMenuAction->unique('id_menu_action')->values();
        @endphp
        <div class="row flex gap-4 mt-8 my-4">
            <div class="w-1/2 bg-gray-100 rounded-md shadow-md p-8">
                <label for="memo" class=" text-sm font-medium">Memo</label>
                <table class="w-full ">
                    @if ($uniqueMemo->isNotEmpty())
                        @foreach ($uniqueMemo as $memo)
                            <tr class="border-b border-gray-300">
                                <td class="py-2">
                                    <span
                                        class="font-medium {{ $memo['status'] === 'selesai' ? 'line-through text-gray-500' : '' }}">
                                        - {{ $memo['memo'] }}
                                    </span>

                                </td>
                                <td class="py-2">
                                    <input type="checkbox" name="status_memo[]" value="{{ $memo['id_memo'] }}"
                                        {{ $memo['status'] === 'selesai' ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600"
                                        disabled>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-300">
                            <td class="py-2">Tidak ada memo.</td>
                        </tr>
                    @endif
                </table>
            </div>
            <div class="w-1/2 bg-gray-100 rounded-md shadow-md p-8">
                <label for="menu-action" class=" text-sm font-medium ">Menu Action</label>
                <table class="w-full ">
                    @if ($uniqueMenuAction->isNotEmpty())
                        @foreach ($uniqueMenuAction as $menu_action)
                            <tr class="border-b border-gray-300">
                                <td class="py-2">
                                    <span
                                        class="font-medium {{ $menu_action['status'] === 'selesai' ? 'line-through text-gray-500' : '' }}">
                                        - {{ $menu_action['menu_action'] }}
                                    </span>
                                </td>
                                <td class="py-2">
                                    <input type="checkbox" name="status_menu_action[]"
                                        value="{{ $menu_action['id_menu_action'] }}"
                                        {{ $menu_action['status'] === 'selesai' ? 'checked' : '' }}
                                        class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600"
                                        disabled>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="border-b border-gray-300">
                            <td class="py-2">Tidak ada menu action.</td>
                        </tr>
                    @endif
                </table>
            </div>
        </div>
    </div>

</x-sidebar-navbar-layout>
