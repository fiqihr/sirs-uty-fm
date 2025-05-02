<x-sidebar-navbar-layout>
    <div id="header" class="mb-8">
        <p class="text-3xl text-gray-600 font-bold mb-2">Dashboard</p>
        <p class="text-lg text-gray-500">Selamat Datang, {{ Auth::user()->name }}! 🖐️</p>
    </div>
    @php
        $akses = Auth::user()->hak_akses;
    @endphp
    <div class="flex gap-4">
        @if ($akses === 'program_director')
            <div class="w-1/2 rounded-md p-4 bg-grd1 shadow-md text-white">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                        <path
                            d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
                    </svg>
                    <p class="mb-4">Penyiar</p>
                </div>
                <p class="text-4xl font-bold">{{ $jumlahPenyiar }}</p>
            </div>
            <div class="w-1/2 rounded-md p-4 bg-grd3 shadow-md text-white">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4">Program</p>
                </div>
                <p class="text-4xl font-bold">{{ $jumlahProgram }}</p>
            </div>
        @elseif ($akses === 'penyiar')
            @include('partials.cdn')
            <div class="mb-8 w-full bg-white rounded-lg shadow-md py-16">
                <p class="font-bold text-xl text-gray-600 mb-4 text-center">Silahkan Pilih Tanggal untuk Melihat
                    Rancangan Siar</p>
                </p>
                <form id="searchForm" method="GET" class=" flex gap-4 w-2/3  mx-auto">
                    <div class="w-full">
                        <select id="selectTanggal" class="select2" name="id_tanggal" style="width: 100%;">
                            <!-- Options will be dynamically loaded via AJAX -->
                        </select>
                    </div>
                    <button type="submit" class="btn-search flex gap-1 items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                        <span>Cari</span>
                    </button>
                </form>
            </div>
        @else
            <div class="w-1/3 rounded-md p-4 bg-grd1 shadow-md text-white">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>
                    <p class="mb-4">Client</p>
                </div>
                <p class="text-4xl font-bold">{{ $jumlahClient }}</p>
            </div>
            <div class="w-1/3 rounded-md p-4 bg-grd2 shadow-md text-white">
                <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M5.636 4.575a.75.75 0 0 1 0 1.061 9 9 0 0 0 0 12.728.75.75 0 1 1-1.06 1.06c-4.101-4.1-4.101-10.748 0-14.849a.75.75 0 0 1 1.06 0Zm12.728 0a.75.75 0 0 1 1.06 0c4.101 4.1 4.101 10.75 0 14.85a.75.75 0 1 1-1.06-1.061 9 9 0 0 0 0-12.728.75.75 0 0 1 0-1.06ZM7.757 6.697a.75.75 0 0 1 0 1.06 6 6 0 0 0 0 8.486.75.75 0 0 1-1.06 1.06 7.5 7.5 0 0 1 0-10.606.75.75 0 0 1 1.06 0Zm8.486 0a.75.75 0 0 1 1.06 0 7.5 7.5 0 0 1 0 10.606.75.75 0 0 1-1.06-1.06 6 6 0 0 0 0-8.486.75.75 0 0 1 0-1.06ZM9.879 8.818a.75.75 0 0 1 0 1.06 3 3 0 0 0 0 4.243.75.75 0 1 1-1.061 1.061 4.5 4.5 0 0 1 0-6.364.75.75 0 0 1 1.06 0Zm4.242 0a.75.75 0 0 1 1.061 0 4.5 4.5 0 0 1 0 6.364.75.75 0 0 1-1.06-1.06 3 3 0 0 0 0-4.243.75.75 0 0 1 0-1.061ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="mb-4">Iklan</p>
                </div>
                <p class="text-4xl font-bold">{{ $jumlahIklan }}</p>
            </div>
            <div class="w-1/3 rounded-md p-4 bg-grd3 shadow-md text-white">
                <div class="flex gap-2">
                    @if ($akses === 'traffic')
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path
                                d="M21.721 12.752a9.711 9.711 0 0 0-.945-5.003 12.754 12.754 0 0 1-4.339 2.708 18.991 18.991 0 0 1-.214 4.772 17.165 17.165 0 0 0 5.498-2.477ZM14.634 15.55a17.324 17.324 0 0 0 .332-4.647c-.952.227-1.945.347-2.966.347-1.021 0-2.014-.12-2.966-.347a17.515 17.515 0 0 0 .332 4.647 17.385 17.385 0 0 0 5.268 0ZM9.772 17.119a18.963 18.963 0 0 0 4.456 0A17.182 17.182 0 0 1 12 21.724a17.18 17.18 0 0 1-2.228-4.605ZM7.777 15.23a18.87 18.87 0 0 1-.214-4.774 12.753 12.753 0 0 1-4.34-2.708 9.711 9.711 0 0 0-.944 5.004 17.165 17.165 0 0 0 5.498 2.477ZM21.356 14.752a9.765 9.765 0 0 1-7.478 6.817 18.64 18.64 0 0 0 1.988-4.718 18.627 18.627 0 0 0 5.49-2.098ZM2.644 14.752c1.682.971 3.53 1.688 5.49 2.099a18.64 18.64 0 0 0 1.988 4.718 9.765 9.765 0 0 1-7.478-6.816ZM13.878 2.43a9.755 9.755 0 0 1 6.116 3.986 11.267 11.267 0 0 1-3.746 2.504 18.63 18.63 0 0 0-2.37-6.49ZM12 2.276a17.152 17.152 0 0 1 2.805 7.121c-.897.23-1.837.353-2.805.353-.968 0-1.908-.122-2.805-.353A17.151 17.151 0 0 1 12 2.276ZM10.122 2.43a18.629 18.629 0 0 0-2.37 6.49 11.266 11.266 0 0 1-3.746-2.504 9.754 9.754 0 0 1 6.116-3.985Z" />
                        </svg>
                        <p class="mb-4">Rancangan Siar</p>
                    @else
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                            <path fill-rule="evenodd"
                                d="M1.5 5.625c0-1.036.84-1.875 1.875-1.875h17.25c1.035 0 1.875.84 1.875 1.875v12.75c0 1.035-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 18.375V5.625Zm1.5 0v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5A.375.375 0 0 0 3 5.625Zm16.125-.375a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5A.375.375 0 0 0 21 7.125v-1.5a.375.375 0 0 0-.375-.375h-1.5ZM21 9.375A.375.375 0 0 0 20.625 9h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5Zm0 3.75a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5a.375.375 0 0 0 .375-.375v-1.5ZM4.875 18.75a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375h1.5ZM3.375 15h1.5a.375.375 0 0 0 .375-.375v-1.5a.375.375 0 0 0-.375-.375h-1.5a.375.375 0 0 0-.375.375v1.5c0 .207.168.375.375.375Zm0-3.75h1.5a.375.375 0 0 0 .375-.375v-1.5A.375.375 0 0 0 4.875 9h-1.5A.375.375 0 0 0 3 9.375v1.5c0 .207.168.375.375.375Zm4.125 0a.75.75 0 0 0 0 1.5h9a.75.75 0 0 0 0-1.5h-9Z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="mb-4">Program</p>
                    @endif
                </div>
                @if ($akses === 'admin' || $akses === 'traffic')
                    <p class="text-4xl font-bold">{{ $jumlahRs }}</p>
                @else
                    <p class="text-4xl font-bold">{{ $jumlahProgram }}</p>
                @endif
            </div>
        @endif
    </div>
    <hr class="my-8">
    @if ($akses === 'traffic')
        <div class="text-gray-600">
            <p class="text-2xl font-bold mb-4">Data Diagram </p>
            <div class="max-w-4xl w-full bg-white rounded-lg shadow-sm  p-4 md:p-6">
                <div class="flex justify-between pb-4 mb-4 border-b border-gray-200">
                    <div class="flex items-center">
                        <div class="w-12 h-12 rounded-lg bg-gray-200  flex items-center justify-center me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-6">
                                <path fill-rule="evenodd"
                                    d="M5.636 4.575a.75.75 0 0 1 0 1.061 9 9 0 0 0 0 12.728.75.75 0 1 1-1.06 1.06c-4.101-4.1-4.101-10.748 0-14.849a.75.75 0 0 1 1.06 0Zm12.728 0a.75.75 0 0 1 1.06 0c4.101 4.1 4.101 10.75 0 14.85a.75.75 0 1 1-1.06-1.061 9 9 0 0 0 0-12.728.75.75 0 0 1 0-1.06ZM7.757 6.697a.75.75 0 0 1 0 1.06 6 6 0 0 0 0 8.486.75.75 0 0 1-1.06 1.06 7.5 7.5 0 0 1 0-10.606.75.75 0 0 1 1.06 0Zm8.486 0a.75.75 0 0 1 1.06 0 7.5 7.5 0 0 1 0 10.606.75.75 0 0 1-1.06-1.06 6 6 0 0 0 0-8.486.75.75 0 0 1 0-1.06ZM9.879 8.818a.75.75 0 0 1 0 1.06 3 3 0 0 0 0 4.243.75.75 0 1 1-1.061 1.061 4.5 4.5 0 0 1 0-6.364.75.75 0 0 1 1.06 0Zm4.242 0a.75.75 0 0 1 1.061 0 4.5 4.5 0 0 1 0 6.364.75.75 0 0 1-1.06-1.06 3 3 0 0 0 0-4.243.75.75 0 0 1 0-1.061ZM10.875 12a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-normal text-gray-500 00">Grafik Data Iklan</p>
                        </div>
                    </div>
                    <div>
                        <h5 class="leading-none text-2xl font-bold text-white pb-1 bg-grd1 py-1 px-2 rounded-lg">2025
                        </h5>

                    </div>
                </div>

                <div class="grid grid-cols-2">

                </div>

                <div id="column-chart"></div>
                <div class="grid grid-cols-1 items-center border-gray-200 border-t  justify-between">
                    <div class="flex justify-between items-center pt-5">
                        <!-- Button -->

                        <!-- Dropdown menu -->


                    </div>
                </div>
            </div>

        </div>
    @endif
    <script>
        const chartData = @json($chartData);

        const options = {
            colors: ["#a70808"],
            series: [{
                name: "Jumlah Iklan",
                color: "#D74B76",
                data: chartData // ini langsung dari Blade
            }],
            chart: {
                type: "bar",
                height: "320px",
                fontFamily: "Inter, sans-serif",
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: "70%",
                    borderRadiusApplication: "end",
                    borderRadius: 8,
                    distributed: true
                },
            },
            xaxis: {
                labels: {
                    style: {
                        fontFamily: "Inter, sans-serif",
                        cssClass: 'text-xs font-normal fill-gray-500 00'
                    }
                },
            },
            yaxis: {
                show: false,
            },
            grid: {
                show: false
            },
            tooltip: {
                shared: true,
                intersect: false
            },
            fill: {
                opacity: 1
            },
            legend: {
                show: false
            },
            dataLabels: {
                enabled: false
            },
        };

        if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
            console.log(chartData)
            const chart = new ApexCharts(document.getElementById("column-chart"), options);
            chart.render();
        }






        $(document).ready(function() {
            $('.select2').select2({
                ajax: {
                    url: "{{ route('get.tanggal.json') }}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    }
                },
                placeholder: 'Pilih tanggal...',
                minimumInputLength: 1,
                minimumInputLength: 1,
                language: {
                    inputTooShort: function(args) {
                        return "Silakan ketik minimal 3 karakter untuk mencari tanggal"; // ✅ Custom teks di sini
                    },
                    noResults: function() {
                        return "Tidak ada tanggal ditemukan";
                    },
                    searching: function() {
                        return "Mencari tanggal...";
                    }
                },
                templateResult: formatOption,
                templateSelection: formatOptionSelected
            });

            function formatOption(data) {
                if (!data.id) {
                    return data.text;
                }
                var $result = $('<div class="flex flex-col">' +
                    '<span class="font-bold">' + data.text + '</span>' +
                    '</div>');
                return $result;
            }

            function formatOptionSelected(data) {
                return data.text || data.id;
            }


            $('#searchForm').on('submit', function(e) {
                e.preventDefault(); // Cegah submit default
                let id = $('#selectTanggal').val(); // Ambil ID yang dipilih
                if (id) {
                    let actionUrl = "{{ route('rancangan-siar.show', ['id' => 'ID_REPLACE']) }}";
                    actionUrl = actionUrl.replace('ID_REPLACE',
                        id); // Ganti placeholder dengan id sebenarnya
                    $(this).attr('action', actionUrl); // Ubah action form
                    this.submit(); // Submit lagi
                } else {
                    alert('Silakan pilih tanggal dulu.');
                }
            });
        });
    </script>
    {{-- <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg ">
        <div class="grid grid-cols-3 gap-4 mb-4">
            <div class="flex items-center justify-center h-24 rounded-sm bg-gray-50 ">
                <p class="text-2xl text-gray-400 ">Content</p>
            </div>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
        <div class="flex items-center justify-center h-48 mb-4 rounded-sm bg-gray-50 ">
            <p class="text-2xl text-gray-400 ">Main Section</p>
        </div>
    </div> --}}
</x-sidebar-navbar-layout>
