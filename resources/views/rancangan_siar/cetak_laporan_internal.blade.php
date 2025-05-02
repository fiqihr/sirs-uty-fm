<!DOCTYPE html>
<html>

<head>
    <title>Laporan Data Internal Client & Iklan</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 50px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px 8px;
            text-align: left;
        }
    </style>
</head>

<body>
    <h2>LAPORAN DATA CLIENT & IKLAN <br>UTY FM MEDARI</h2>
    <table style="border: none; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>Periode</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">{{ $bulanDipilih }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th style="text-align: center" width="5%">No</th>
                <th style="text-align: center">Nama Client</th>
                <th style="text-align: center">Nama Iklan</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grouped = collect($iklanClient)->groupBy('nama_client');
                $no = 1;
            @endphp

            @forelse ($grouped as $client => $iklans)
                @php $rowspan = count($iklans); @endphp
                @foreach ($iklans as $index => $iklan)
                    <tr>
                        @if ($index == 0)
                            <td style="text-align: center" rowspan="{{ $rowspan }}">{{ $no }}</td>
                            <td rowspan="{{ $rowspan }}">{{ $client }}</td>
                            @php $no++; @endphp
                        @endif
                        <td>{{ $iklan['nama_iklan'] }}</td>
                    </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="3">Tidak ada data client dan data iklan</td>
                </tr>
            @endforelse

        </tbody>
    </table>

    <div style="margin-top: 50px; width: 100%;">
        <br><br><br>
        <div style="width: 50%; float: right; text-align: right;">
            <p style="margin: 0;">TRAFFIC UTY FM MEDARI</p>
            <br><br><br>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">CITRA</p>
        </div>
    </div>
</body>

</html>
