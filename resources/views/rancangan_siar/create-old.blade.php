<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Rancangan Siar</p>
        <p class="text-sm">Tambah Data Rancangan Siar</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        @if ($errors->any())
            <div class="text-red-500 text-sm mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('rancangan-siar.store') }}" method="POST">
            @csrf
            <div class="">
                <div class="mb-5 w-2/3 mx-auto">
                    <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-600 ">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                        required />
                    <p id="peringatan-tanggal" class="text-red-500 text-sm hidden mt-1 text-center italic"></p>
                </div>
                <div class="mb-5">
                    <div id="accordion-collapse" data-accordion="collapse">
                        <h2 id="accordion-collapse-heading-1">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right  border border-b-0 border-gray-200  rounded-md focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
                                data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span class="font-bold">06:00 WIB - 10:00 WIB</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-1" class="hidden"
                            aria-labelledby="accordion-collapse-heading-1">
                            <div class="p-5 border border-b-0 border-gray-200 ">
                                <div class="relative overflow-x-auto shadow-sm sm:rounded-md">
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
                                            <tr data-index="0"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                {{-- <input type="hidden" name="jam[]" value="06:00 - 07:00"> --}}
                                                <input type="hidden" name="data[0][jam]" value="06:00 - 07:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    06:00 - 07:00
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
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="1"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[1][jam]" value="07:00 - 08:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    07:00 - 08:00
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
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="2"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[2][jam]" value="08:00 - 09:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    08:00 - 09:00
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
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="3"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[3][jam]" value="09:00 - 10:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    09:00 - 10:00
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
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                        </tbody>
                                    </table>
                                    <div class="flex w-full gap-4 mt-12 mb-4">
                                        <div class="memo-container w-1/2 rounded-md shadow-lg p-4 bg-gray-100">
                                            <label for="memo"
                                                class="block mb-2 text-gray-600 font-bold">Memo</label>
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" name="memo[]"
                                                    class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                                                    placeholder="Masukkan memo..." />
                                                <button type="button" onclick="tambahMemo(this)"
                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-6">
                                                        <path fill-rule="evenodd"
                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-1/2 rounded-md shadow-lg p-4 bg-gray-100"
                                            id="menu-action-container">
                                            <label for="menu_action" class="block mb-2 text-gray-600 font-bold">Menu
                                                Action</label>
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" id="menu_action" name="menu_action[]"
                                                    class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                                                    placeholder="Masukkan menu action/acara..." />
                                                <button type="button" onclick="tambahMenuAction(this)"
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
                                </div>
                            </div>
                        </div>
                        <h2 id="accordion-collapse-heading-2">
                            <button type="button"
                                class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-primary border border-b-0 border-gray-200 text-secondary rounded-md focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
                                data-accordion-target="#accordion-collapse-body-2" aria-expanded="true"
                                aria-controls="accordion-collapse-body-1">
                                <span class="font-bold">10:00 WIB - 15:00 WIB</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M9 5 5 1 1 5" />
                                </svg>
                            </button>
                        </h2>
                        <div id="accordion-collapse-body-2" class="hidden"
                            aria-labelledby="accordion-collapse-heading-2">
                            <div class="p-5 border border-b-0 border-gray-200 ">
                                <div class="relative overflow-x-auto shadow-sm sm:rounded-md">
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
                                            <tr data-index="4"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                {{-- <input type="hidden" name="jam[]" value="06:00 - 07:00"> --}}
                                                <input type="hidden" name="data[4][jam]" value="10:00 - 11:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    10:00 - 11:00
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
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="5"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[5][jam]" value="11:00 - 12:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    11:00 - 12:00
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                        <div class="flex gap-2">
                                                            <div class="w-2/5">
                                                                <select id="iklan" name="data[5][iklan][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Iklan </option>
                                                                    @foreach ($iklan as $item)
                                                                        <option value="{{ $item->id_iklan }}">
                                                                            {{ $item->nama_iklan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-2/5">
                                                                <select id="kuadran" name="data[5][kuadran][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Kuadran </option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                            <div class="w-1/5 text-center">
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="6"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[6][jam]" value="12:00 - 13:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    12:00 - 13:00
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                        <div class="flex gap-2">
                                                            <div class="w-2/5">
                                                                <select id="iklan" name="data[6][iklan][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Iklan </option>
                                                                    @foreach ($iklan as $item)
                                                                        <option value="{{ $item->id_iklan }}">
                                                                            {{ $item->nama_iklan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-2/5">
                                                                <select id="kuadran" name="data[6][kuadran][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Kuadran </option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                            <div class="w-1/5 text-center">
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="7"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[7][jam]" value="13:00 - 14:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    13:00 - 14:00
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                        <div class="flex gap-2">
                                                            <div class="w-2/5">
                                                                <select id="iklan" name="data[7][iklan][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Iklan </option>
                                                                    @foreach ($iklan as $item)
                                                                        <option value="{{ $item->id_iklan }}">
                                                                            {{ $item->nama_iklan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-2/5">
                                                                <select id="kuadran" name="data[7][kuadran][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Kuadran </option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                            <div class="w-1/5 text-center">
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                            <tr data-index="8"
                                                class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                                <input type="hidden" name="data[8][jam]" value="14:00 - 15:00">
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                    14:00 - 15:00
                                                </th>
                                                <td class="px-6 py-4">
                                                    <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                        <div class="flex gap-2">
                                                            <div class="w-2/5">
                                                                <select id="iklan" name="data[8][iklan][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Iklan </option>
                                                                    @foreach ($iklan as $item)
                                                                        <option value="{{ $item->id_iklan }}">
                                                                            {{ $item->nama_iklan }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="w-2/5">
                                                                <select id="kuadran" name="data[8][kuadran][]"
                                                                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                    <option selected disabled> Pilih Kuadran </option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                </select>
                                                            </div>
                                                            <div class="w-1/5 text-center">
                                                                <button type="button"
                                                                    onclick="tambahIklanKuadran(this)"
                                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md"><svg
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 24 24" fill="currentColor"
                                                                        class="size-6">
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
                                        </tbody>
                                    </table>
                                    <div class="flex w-full gap-4 mt-12 mb-4">
                                        <div class="memo-container w-1/2 rounded-md shadow-lg p-4 bg-gray-100">
                                            <label for="memo"
                                                class="block mb-2 text-gray-600 font-bold">Memo</label>
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" name="memo[]"
                                                    class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                                                    placeholder="Masukkan memo..." />
                                                <button type="button" onclick="tambahMemo(this)"
                                                    class="hover:shadow-lg hover:bg-sky-200 transition-all transition-duration-300 text-sky-500 font-bold py-1 px-3 rounded-md">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="currentColor" class="size-6">
                                                        <path fill-rule="evenodd"
                                                            d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 9a.75.75 0 0 0-1.5 0v2.25H9a.75.75 0 0 0 0 1.5h2.25V15a.75.75 0 0 0 1.5 0v-2.25H15a.75.75 0 0 0 0-1.5h-2.25V9Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="w-1/2 rounded-md shadow-lg p-4 bg-gray-100"
                                            id="menu-action-container">
                                            <label for="menu_action" class="block mb-2 text-gray-600 font-bold">Menu
                                                Action</label>
                                            <div class="flex gap-2 mb-2">
                                                <input type="text" id="menu_action" name="menu_action[]"
                                                    class="bg-gray-100 border-0 border-b border-gray-300 text-gray-600 text-sm focus:ring-0 focus:border-gray-500 block w-full px-2.5 py-2"
                                                    placeholder="Masukkan menu action/acara..." />
                                                <button type="button" onclick="tambahMenuAction(this)"
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-2">
                    <button type="submit" id="btn-submit"
                        class="hover:bg-green-200 transition-all transition-duration-300 text-green-600 font-bold py-2 px-4 rounded-full"><i
                            class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                    </button>
                </div>
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
            const container = document.getElementsByClassName('memo-container');
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

{{-- function tambahIklanKuadran(btn) {
    const parent = btn.closest('td');
    const container = parent.querySelector('.iklan_kuadran');

    // utk wrapper utama
    const wrapperDiv = document.createElement('div');
    wrapperDiv.className = "flex items-center gap-2 mt-2 baris-kuadran";

    // select iklan
    const selectIklanWrapper = document.createElement('div');
    selectIklanWrapper.className = "w-2/5";

    const selectIklan = document.createElement('select');
    selectIklan.name = "id_iklan[]";
    selectIklan.className =
        "bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 w-full p-2.5";

    selectIklan.innerHTML = `<option selected disabled>Pilih Iklan</option>`;

    // coba ambil data
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

    // select kuadran
    const selectKuadranWrapper = document.createElement('div');
    selectKuadranWrapper.className = "w-2/5";

    const selectKuadran = document.createElement('select');
    selectKuadran.name = "kuadran[]";
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

    // btn hapus
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

    // gabung semuanya
    wrapperDiv.appendChild(selectIklanWrapper);
    wrapperDiv.appendChild(selectKuadranWrapper);
    wrapperDiv.appendChild(deleteBtnWrapper);


    // tambah ke container
    container.appendChild(wrapperDiv);
}

function hapusBaris(btn) {
    const baris = btn.closest('.baris-kuadran');
    baris.remove();
} --}}
