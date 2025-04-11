<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Rancangan Siar</p>
        <p class="text-sm">Tambah Data Rancangan Siar</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form class="">
            @csrf
            <div class="mb-5 w-2/3 mx-auto">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-600 ">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
            </div>
            <div class="mb-5">
                <div id="accordion-collapse" data-accordion="collapse">
                    <h2 id="accordion-collapse-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-primary border border-b-0 border-gray-200 text-secondary rounded-t-md focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
                            data-accordion-target="#accordion-collapse-body-1" aria-expanded="true"
                            aria-controls="accordion-collapse-body-1">
                            <span>06:00 WIB - 10:00 WIB</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
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
                                        <tr class="bg-white border-b   border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                06:00 - 07:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2 w-full">
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Iklan </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Kuadran </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-1/5 text-center">
                                                        <button onclick="console.log('test')"
                                                            class="hover:bg-orange-200 transition-all transition-duration-300 text-orange-500 font-bold py-1 px-3 rounded-md">Tambah</button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-50 border-b   border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                07:00 - 08:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2 w-full">
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Iklan </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Kuadran </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-1/5 text-center">
                                                        <button
                                                            class="hover:bg-orange-200 transition-all transition-duration-300 text-orange-500 font-bold py-1 px-3 rounded-md">Tambah</button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="bg-white border-b   border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                08:00 - 09:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2 w-full">
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Iklan </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Kuadran </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-1/5 text-center">
                                                        <button
                                                            class="hover:bg-orange-200 transition-all transition-duration-300 text-orange-500 font-bold py-1 px-3 rounded-md">Tambah</button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                        <tr class="bg-gray-50 border-b border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                09:00 - 10:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-2 w-full">
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Iklan </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-2/5">
                                                        <select id="id_client" name="id_client"
                                                            class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                            <option selected disabled> Pilih Kuadran </option>
                                                            <option value="#">1</option>
                                                        </select>
                                                    </div>
                                                    <div class="w-1/5 text-center">
                                                        <button
                                                            class="hover:bg-orange-200 transition-all transition-duration-300 text-orange-500 font-bold py-1 px-3 rounded-md">Tambah</button>
                                                    </div>
                                                </div>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <h2 id="accordion-collapse-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200   hover:bg-gray-100  gap-3"
                            data-accordion-target="#accordion-collapse-body-2" aria-expanded="false"
                            aria-controls="accordion-collapse-body-2">
                            <span>10:00 WIB - 15:00 WIB</span>
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
                            belum ada
                        </div>
                    </div>
                    <h2 id="accordion-collapse-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
                            data-accordion-target="#accordion-collapse-body-3" aria-expanded="false"
                            aria-controls="accordion-collapse-body-3">
                            <span>15:00 WIB - 20:00 WIB</span>
                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 5 5 1 1 5" />
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-collapse-body-3" class="hidden"
                        aria-labelledby="accordion-collapse-heading-3">
                        <div class="p-5 border border-t-0 border-gray-200 ">
                            belum ada
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit"
                    class="hover:bg-green-200 transition-all transition-duration-300 text-green-500 font-bold py-1 px-3 rounded-md"><i
                        class="fa-solid fa-floppy-disk"></i><span class="ml-1 font-bold">Simpan</span>
                </button>
            </div>
        </form>
    </div>
</x-sidebar-navbar-layout>
