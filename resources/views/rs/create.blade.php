<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-4 flex flex-col gap-2">
        <p class="font-bold text-4xl">Tambah Rancangan Siar</p>
        <p class="text-sm">Tambah Data Rancangan Siar</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <div class="">
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
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-primary border border-b-0 border-gray-200 text-secondary rounded-md focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
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
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                06:00 - 07:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                    <div class="flex gap-2">
                                                        <div class="w-2/5">
                                                            <select id="iklan" name="iklan[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Iklan </option>
                                                                @foreach ($iklan as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama_iklan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="w-2/5">
                                                            <select id="kuadran" name="kuadran[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Kuadran </option>
                                                                <option value="#">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="w-1/5 text-center">
                                                            <button onclick="tambahIklanKuadran(this)"
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
                                        <tr class="bg-gray-50 border-b border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                07:00 - 08:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                    <div class="flex gap-2">
                                                        <div class="w-2/5">
                                                            <select id="iklan" name="iklan[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Iklan </option>
                                                                @foreach ($iklan as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama_iklan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="w-2/5">
                                                            <select id="kuadran" name="kuadran[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Kuadran </option>
                                                                <option value="#">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="w-1/5 text-center">
                                                            <button onclick="tambahIklanKuadran(this)"
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
                            </div>
                        </div>
                    </div>
                    <h2 id="accordion-collapse-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium rtl:text-right bg-primary border border-b-0 border-gray-200 text-secondary rounded-md focus:ring-4 focus:ring-gray-200  hover:bg-gray-100  gap-3"
                            data-accordion-target="#accordion-collapse-body-2" aria-expanded="true"
                            aria-controls="accordion-collapse-body-1">
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
                                        <tr class="bg-white border-b border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                10:00 - 11:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                    <div class="flex gap-2">
                                                        <div class="w-2/5">
                                                            <select id="iklan" name="iklan[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Iklan </option>
                                                                @foreach ($iklan as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama_iklan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="w-2/5">
                                                            <select id="kuadran" name="kuadran[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Kuadran </option>
                                                                <option value="#">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="w-1/5 text-center">
                                                            <button onclick="tambahIklanKuadran(this)"
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
                                        <tr class="bg-gray-50 border-b border-gray-200 hover:bg-gray-50 ">
                                            <th scope="row"
                                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                                11:00 - 12:00
                                            </th>
                                            <td class="px-6 py-4">
                                                <div class="iklan_kuadran flex flex-col gap-2 w-full">
                                                    <div class="flex gap-2">
                                                        <div class="w-2/5">
                                                            <select id="iklan" name="iklan[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Iklan </option>
                                                                @foreach ($iklan as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->nama_iklan }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="w-2/5">
                                                            <select id="kuadran" name="kuadran[]"
                                                                class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5 ">
                                                                <option selected disabled> Pilih Kuadran </option>
                                                                <option value="#">1</option>
                                                            </select>
                                                        </div>
                                                        <div class="w-1/5 text-center">
                                                            <button onclick="tambahIklanKuadran(this)"
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
                            </div>
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
        </div>
    </div>
    <script>
        function tambahIklanKuadran(btn) {
            const parent = btn.closest('td');
            const container = parent.querySelector('.iklan_kuadran');

            // Select Iklan
            const selectIklan = document.createElement('select');
            selectIklan.name = "iklan[]";
            selectIklan.className =
                "w-2/5 bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 w-full p-2.5";
            selectIklan.innerHTML = `
        <option selected disabled>Pilih Iklan</option>
        <option value="1">Iklan 1</option>
        <option value="2">Iklan 2</option>
    `;

            // Select Kuadran
            const selectKuadran = document.createElement('select');
            selectKuadran.name = "kuadran[]";
            selectKuadran.className =
                "w-2/5 bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 w-full p-2.5";
            selectKuadran.innerHTML = `
        <option selected disabled>Pilih Kuadran</option>
        <option value="A">Kuadran A</option>
        <option value="B">Kuadran B</option>
    `;

            // Tombol Hapus
            // Tombol hapus sebagai div dengan icon SVG
            const deleteBtn = document.createElement('div');
            deleteBtn.className = "text-center w-1/5 text-red-600 cursor-pointer flex items-center justify-center";
            deleteBtn.innerHTML = `<div class="py-1 px-3 rounded-md hover:bg-red-200 hover:shadow-lg transition-all">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
  <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25Zm3 10.5a.75.75 0 0 0 0-1.5H9a.75.75 0 0 0 0 1.5h6Z" clip-rule="evenodd" />
</svg></div>

`;
            deleteBtn.onclick = function() {
                barisForm.remove(); // hapus baris form ini
            };


            // Gabungkan ke dalam satu baris flex
            const barisForm = document.createElement('div');
            barisForm.className = "flex gap-2 items-center"; // items-center biar tombol hapus sejajar
            barisForm.appendChild(selectIklan);
            barisForm.appendChild(selectKuadran);
            barisForm.appendChild(deleteBtn);

            // Tambahkan ke dalam container
            container.appendChild(barisForm);
        }
    </script>
</x-sidebar-navbar-layout>
