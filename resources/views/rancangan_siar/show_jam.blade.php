<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Rentang Jam Rancangan Siar</p>
        <p class="text-sm italic">Detail Rentang Jam Rancangan Siar</p>
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
                    <select id="penyiar" name="penyiar" class="input-form">
                        <option selected disabled> --- </option>
                        @foreach ($semuaPenyiar as $penyiar)
                            <option value="{{ $penyiar->id }}" @if ($penyiar->id == Auth::id()) selected @endif>
                                {{ $penyiar->name }}
                            </option>
                            {{-- <option value="{{ $penyiar->id }}" @if (in_array($penyiar->id, $cekPenyiar) || (empty($cekPenyiar) && $penyiar->id == Auth::id())) selected @endif>
                                {{ $penyiar->name }}
                            </option> --}}
                        @endforeach
                    </select>
                </div>
                <div class="mb-5 w-1/2">
                    <label for="program" class="block mb-2 text-sm font-bold ">Nama Program</label>
                    <select id="program" name="program" class="input-form">
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
                                    <div class="flex items-center ">
                                        <p class="w-1/3">
                                            Iklan: <span class="font-bold">{{ $item->iklan->nama_iklan }}</span>
                                        </p>
                                        <p class="w-1/3">
                                            Kuadran: <span class="font-bold">{{ $item->kuadran }}</span>
                                        </p>
                                        <div class="flex items-center gap-2 w-1/3">
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
                                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600">
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
                                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600">
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
            <hr class="my-8">
            <div class="flex justify-end mt-5">
                <button type="submit" id="btn-submit" class="btn-simpan"><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>

</x-sidebar-navbar-layout>
