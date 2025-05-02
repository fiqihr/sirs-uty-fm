<x-sidebar-navbar-layout>
    <div class="text-gray-600 mb-8 flex flex-col gap-2">
        <p class="font-bold text-4xl">Laporan</p>
        <p class="text-sm italic">Cetak Laporan Internal</p>
    </div>
    <div class="container w-full px-4 py-8 bg-white rounded-md shadow-md">
        <form action="{{ route('cetakLaporanInternal') }}" method="POST" class="w-2/3 mx-auto">
            @csrf
            <div class="mb-5">
                <label for="tanggal" class="block mb-2 text-sm font-medium text-gray-600 ">Periode Bulan</label>
                <select id="tanggal" name="tanggal" class="input-form mb-4">
                    <option selected disabled> --- </option>
                    @foreach ($bulan as $item)
                        <option value="{{ $item['bulanRaw'] }}">{{ $item['bulan'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="mt-8 
                        bg-yellow_1 bg-opacity-70
                        hover:shadow-xl hover:bg-red_1 hover:bg-opacity-70 transition duration-300 text-gray-600 hover:text-white py-3 px-4 rounded-full block font-semibold"><i
                        class="fa-solid fa-print"></i><span class="ml-1 font-bold">Cetak Laporan</span>
                </button>
            </div>
        </form>
    </div>
    <script>
        document.getElementById('id_client').addEventListener('change', function() {
            const clientId = this.value;
            const iklanSelect = document.getElementById('id_iklan');

            iklanSelect.innerHTML = '<option selected disabled> --- </option>';

            fetch(`/get-iklan-by-client/${clientId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(function(iklan) {
                        const option = document.createElement('option');
                        option.value = iklan.id_iklan;
                        option.textContent = iklan.nama_iklan;
                        // tambahkan data attribute untuk tanggal
                        option.dataset.mulai = iklan.periode_siar_mulai;
                        option.dataset.selesai = iklan.periode_siar_selesai;
                        iklanSelect.appendChild(option);
                    });
                });
        });

        document.getElementById('id_iklan').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const mulai = selectedOption.dataset.mulai;
            const selesai = selectedOption.dataset.selesai;

            const inputMulai = document.getElementById('periode_siar_mulai');
            const inputSelesai = document.getElementById('periode_siar_selesai');

            inputMulai.min = mulai;
            inputMulai.max = selesai;
            inputSelesai.min = mulai;
            inputSelesai.max = selesai;

            // Kosongkan nilai input jika sudah terisi sebelumnya
            inputMulai.value = '';
            inputSelesai.value = '';
        });
    </script>
</x-sidebar-navbar-layout>
