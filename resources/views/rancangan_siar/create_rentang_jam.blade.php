<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex flex-col gap-2">
        <p class="font-bold text-4xl mb-2">Rentang Jam Rancangan Siar</p>
        <p class="text-sm italic">Rancangan Siar &rsaquo; Tambah Tanggal &rsaquo; Menu Rancangan Siar &rsaquo; Tambah
            Rentang Jam</p>
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
        @if ($rancanganSiar->isNotEmpty())
            <p class="text-base italic font-bold my-2">&raquo; Rentang Jam yang sudah ada</p>
            <form action="{{ route('simpan.menit') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="relative overflow-x-auto shadow-md sm:rounded-md mb-8">
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
                                                    value="{{ $item->menit_putar ?? null }}"
                                                    oninput="validity.valid || (value = '')">
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr class="my-8">
                    <div class="flex justify-end mt-2 p-4">
                        <button type="submit" id="btn-submit" class="btn-simpan"><i
                                class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Update Menit
                                Pemutaran</span>
                        </button>
                    </div>
                    {{-- yang lama --}}
                    {{-- <table
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
                                            <p>Jam:menit :</p>
                                            <p class="font-bold">{{ formatMenit($item->menit_putar) }} WIB</p>
                                        </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table> --}}
                </div>
            </form>
        @endif
        <p class="text-base italic font-bold mb-2 my-4">&raquo; Input Rentang Jam</p>
        <form action="{{ route('rancangan-siar.store') }}" method="POST">
            <input type="hidden" value="{{ $tanggal->id_tgl_rs }}" name="tanggal">
            @csrf
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 ">
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
                    <tr data-index="0" class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                        {{-- <input type="hidden" name="jam[]" value="06:00 - 07:00"> --}}
                        <input type="hidden" name="data[0][jam]" value="{{ $jamList[0] ?? '' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $jamList[0] ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                <div class="flex gap-2">
                                    <div class="w-2/5">
                                        <select id="iklan" name="data[0][iklan][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Iklan </option>
                                            @foreach ($iklan as $item)
                                                <option value="{{ $item->id_iklan }}">
                                                    {{ $item->nama_iklan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-2/5">
                                        <select id="kuadran" name="data[0][kuadran][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Kuadran </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="w-1/5 text-center">
                                        <button type="button" onclick="tambahIklanKuadran(this)"
                                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr data-index="1" class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                        <input type="hidden" name="data[1][jam]" value="{{ $jamList[1] ?? '' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $jamList[1] ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                <div class="flex gap-2">
                                    <div class="w-2/5">
                                        <select id="iklan" name="data[1][iklan][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Iklan </option>
                                            @foreach ($iklan as $item)
                                                <option value="{{ $item->id_iklan }}">
                                                    {{ $item->nama_iklan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-2/5">
                                        <select id="kuadran" name="data[1][kuadran][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Kuadran </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="w-1/5 text-center">
                                        <button type="button" onclick="tambahIklanKuadran(this)"
                                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr data-index="2" class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                        <input type="hidden" name="data[2][jam]" value="{{ $jamList[2] ?? '' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $jamList[2] ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                <div class="flex gap-2">
                                    <div class="w-2/5">
                                        <select id="iklan" name="data[2][iklan][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Iklan </option>
                                            @foreach ($iklan as $item)
                                                <option value="{{ $item->id_iklan }}">
                                                    {{ $item->nama_iklan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-2/5">
                                        <select id="kuadran" name="data[2][kuadran][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Kuadran </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="w-1/5 text-center">
                                        <button type="button" onclick="tambahIklanKuadran(this)"
                                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr data-index="3" class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                        <input type="hidden" name="data[3][jam]" value="{{ $jamList[3] ?? '' }}">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                            {{ $jamList[3] ?? '' }}
                        </th>
                        <td class="px-6 py-4">
                            <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                <div class="flex gap-2">
                                    <div class="w-2/5">
                                        <select id="iklan" name="data[3][iklan][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Iklan </option>
                                            @foreach ($iklan as $item)
                                                <option value="{{ $item->id_iklan }}">
                                                    {{ $item->nama_iklan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="w-2/5">
                                        <select id="kuadran" name="data[3][kuadran][]"
                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                            <option selected disabled> Pilih Kuadran </option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                        </select>
                                    </div>
                                    <div class="w-1/5 text-center">
                                        <button type="button" onclick="tambahIklanKuadran(this)"
                                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                fill="currentColor" class="size-6">
                                                <path fill-rule="evenodd"
                                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    @if (count($jamList) > 4)
                        <tr data-index="4" class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                            <input type="hidden" name="data[4][jam]" value="{{ $jamList[4] ?? '' }}">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                {{ $jamList[4] ?? '' }}
                            </th>
                            <td class="px-6 py-4">
                                <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                    <div class="flex gap-2">
                                        <div class="w-2/5">
                                            <select id="iklan" name="data[4][iklan][]"
                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                <option selected disabled> Pilih Iklan </option>
                                                @foreach ($iklan as $item)
                                                    <option value="{{ $item->id_iklan }}">
                                                        {{ $item->nama_iklan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="w-2/5">
                                            <select id="kuadran" name="data[4][kuadran][]"
                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                <option selected disabled> Pilih Kuadran </option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                            </select>
                                        </div>
                                        <div class="w-1/5 text-center">
                                            <button type="button" onclick="tambahIklanKuadran(this)"
                                                class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                    fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd"
                                                        d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
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
            <div class="flex w-full gap-4 mt-12 mb-4">
                <div class="w-1/2 rounded-md shadow-lg p-4 bg-gray-100" id="memo-container">
                    <label for="memo" class="block mb-2 text-gray-600 font-bold">Memo</label>
                    @if ($uniqueMemo->isNotEmpty())
                        <table class="w-full text-sm">
                            @foreach ($uniqueMemo as $memo)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2">
                                        <span
                                            class="font-medium {{ $memo['status'] === 'selesai' ? 'line-through text-gray-500' : '' }}">
                                            - {{ $memo['memo'] }}
                                        </span>

                                    </td>
                                    <td class="py-2 flex justify-end pr-4">
                                        <input type="checkbox" name="status_memo[]" value="{{ $memo['id_memo'] }}"
                                            {{ $memo['status'] === 'selesai' ? 'checked' : '' }}
                                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600"
                                            disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <div class="flex gap-2 mb-2">
                        <input type="text" name="memo[]"
                            class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                            placeholder="Masukkan memo..." />
                        <button type="button" onclick="tambahMemo(this)"
                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-1/2 rounded-md shadow-lg p-4 bg-gray-100" id="menu-action-container">
                    <label for="menu_action" class="block mb-2 text-gray-600 font-bold">Menu
                        Action</label>
                    @if ($uniqueMenuAction->isNotEmpty())
                        <table class="w-full text-sm">
                            @foreach ($uniqueMenuAction as $menu_action)
                                <tr class="border-b border-gray-300">
                                    <td class="py-2">
                                        <span
                                            class="font-medium {{ $menu_action['status'] === 'selesai' ? 'line-through text-gray-500' : '' }}">
                                            - {{ $menu_action['menu_action'] }}
                                        </span>

                                    </td>
                                    <td class="py-2 flex justify-end pr-4">
                                        <input type="checkbox" name="status_menu_action[]"
                                            value="{{ $menu_action['id_menu_action'] }}"
                                            {{ $menu_action['status'] === 'selesai' ? 'checked' : '' }}
                                            class="w-4 h-4 text-emerald-600 bg-gray-100 border-gray-300 rounded-sm focus:ring-gray-500 dark:focus:ring-gray-600"
                                            disabled>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    @endif
                    <div class="flex gap-2 mb-2">
                        <input type="text" id="menu_action" name="menu_action[]"
                            class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                            placeholder="Masukkan menu action/acara..." />
                        <button type="button" onclick="tambahMenuAction(this)"
                            class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <hr class="my-8">
            <div class="flex justify-end mt-2">
                <button type="submit" id="btn-submit" class="btn-simpan"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>

    </div>
    <script>
        function tambahIklanKuadran(btn) {
            const parentTd = btn.closest('td');
            const container = parentTd.querySelector('.iklan_kuadran');

            // const jumlahBaris = container.querySelectorAll('.baris-kuadran').length;
            // if (jumlahBaris >= 3) {
            //     btn.disabled = true;
            //     return;
            // }

            // Ambil index baris berdasarkan atribut data-index pada parent <tr>
            const tr = btn.closest('tr');
            const index = tr.dataset.index;

            // Buat wrapper utama
            const wrapperDiv = document.createElement('div');
            wrapperDiv.className = "flex items-center gap-2 mt-2 baris-kuadran";

            // Select Iklan
            const selectIklanWrapper = document.createElement('div');
            selectIklanWrapper.className = "w-2/5";

            const selectIklan = document.createElement('select');
            selectIklan.name = `data[${index}][iklan][]`;
            selectIklan.className =
                "bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 w-full p-2.5";

            selectIklan.innerHTML = `<option selected disabled>Pilih Iklan</option>`;

            // Ambil data iklan dari server
            fetch('/iklan/json')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const option = document.createElement('option');
                        option.value = item.id_iklan;
                        option.textContent = item.nama_iklan;
                        selectIklan.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Gagal mengambil data iklan:', error);
                });

            selectIklanWrapper.appendChild(selectIklan);

            // Select Kuadran
            const selectKuadranWrapper = document.createElement('div');
            selectKuadranWrapper.className = "w-2/5";

            const selectKuadran = document.createElement('select');
            selectKuadran.name = `data[${index}][kuadran][]`;
            selectKuadran.className =
                "bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 w-full p-2.5";

            selectKuadran.innerHTML = `
      <option selected disabled>Pilih Kuadran</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
  `;

            selectKuadranWrapper.appendChild(selectKuadran);

            // Tombol Hapus
            const deleteBtnWrapper = document.createElement('div');
            deleteBtnWrapper.className = "w-1/5 flex items-center justify-center";

            const deleteBtn = document.createElement('button');
            deleteBtn.type = "button";
            deleteBtn.onclick = function() {
                hapusBaris(this);
            };
            deleteBtn.className = "text-red-500 hover:text-red-700";
            deleteBtn.innerHTML = `
      <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-6" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
      </svg>
  `;

            deleteBtnWrapper.appendChild(deleteBtn);

            // Gabungkan semua
            wrapperDiv.appendChild(selectIklanWrapper);
            wrapperDiv.appendChild(selectKuadranWrapper);
            wrapperDiv.appendChild(deleteBtnWrapper);

            container.appendChild(wrapperDiv);
        }

        function hapusBaris(btn) {
            const baris = btn.closest('.baris-kuadran');
            baris.remove();
        }


        const inputTanggal = document.getElementById('tanggal');
        const warning = document.getElementById('peringatan-tanggal');
        const btnSubmit = document.getElementById('btn-submit');

        inputTanggal.addEventListener('change', function() {
            const tanggal = this.value;

            fetch(`/cek-tanggal?tanggal=${tanggal}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Tampilkan pesan peringatan
                        warning.textContent = "Tanggal ini sudah digunakan. Silakan pilih tanggal lain.";
                        warning.classList.remove('hidden');

                        // Ubah border input menjadi merah
                        inputTanggal.classList.remove('border-gray-300', 'focus:border-gray-500');
                        inputTanggal.classList.add('border-red-500', 'focus:border-red-500');

                        // Nonaktifkan tombol submit
                        btnSubmit.disabled = true;
                    } else {
                        // Sembunyikan pesan peringatan
                        warning.textContent = "";
                        warning.classList.add('hidden');

                        // Reset ke warna default
                        inputTanggal.classList.remove('border-red-500', 'focus:border-red-500');
                        inputTanggal.classList.add('border-gray-300', 'focus:border-gray-500');

                        // Aktifkan tombol submit
                        btnSubmit.disabled = false;
                    }
                });
        });

        function tambahMemo(button) {
            const container = document.getElementById('memo-container');
            const flexDiv = button.closest('.flex');
            const newFlex = flexDiv.cloneNode(true);

            // Bersihkan nilai input baru
            newFlex.querySelector('input').value = '';

            // Ubah tombol tambah menjadi tombol hapus
            const newButton = newFlex.querySelector('button');
            newButton.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-6" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
      </svg>`;
            newButton.className =
                'hover:shadow-lg hover:bg-red-200 transition-all transition-duration-300 text-red-500 font-bold py-1 px-3 rounded-md';
            newButton.onclick = function() {
                hapusMemo(newButton);
            };

            container.appendChild(newFlex);
        }

        function hapusMemo(button) {
            const flexDiv = button.closest('.flex');
            flexDiv.remove();
        }

        // tambah menu action
        function tambahMenuAction(button) {
            const container = document.getElementById('menu-action-container');
            const flexDiv = button.closest('.flex');
            const newFlex = flexDiv.cloneNode(true);

            // Bersihkan nilai input baru
            newFlex.querySelector('input').value = '';

            // Ubah tombol tambah menjadi tombol hapus
            const newButton = newFlex.querySelector('button');
            newButton.innerHTML =
                `<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size-6" viewBox="0 0 24 24">
          <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
      </svg>`;
            newButton.className =
                'hover:shadow-lg hover:bg-red-200 transition-all transition-duration-300 text-red-500 font-bold py-1 px-3 rounded-md';
            newButton.onclick = function() {
                hapusMenuAction(newButton);
            };

            container.appendChild(newFlex);
        }

        function hapusMenuAction(button) {
            const flexDiv = button.closest('.flex');
            flexDiv.remove();
        };
    </script>
</x-sidebar-navbar-layout>
