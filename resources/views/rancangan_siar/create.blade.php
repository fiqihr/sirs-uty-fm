<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex flex-col gap-2">
        <p class="font-bold text-4xl mb-2">Tanggal Rancangan Siar</p>
        <p class="text-sm italic">Rancangan Siar &rsaquo; Tambah Tanggal</p>
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
        <form action="{{ route('tambah.tanggal') }}" method="POST" class="w-2/3 mx-auto ">
            @csrf
            <div class="mb-5 ">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-600 ">Tanggal</label>
                <input type="date" id="tanggal" name="tanggal"
                    class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-full focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                    required />
                <p id="peringatan-tanggal" class="text-red-500 text-sm hidden mt-1 text-center italic"></p>
            </div>
            <div class="flex justify-end mt-2">
                <button type="submit" class="btn-simpan"><i class="fa-solid fa-floppy-disk"></i><span
                        class="ml-1 font-bold">Simpan</span>
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
