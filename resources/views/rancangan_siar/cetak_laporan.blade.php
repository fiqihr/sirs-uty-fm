<!DOCTYPE html>
<html>

<head>
    <title>LAPORAN BUKTI SIAR</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
            padding: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 50px;
            text-decoration: underline
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
    <h2>LAPORAN BUKTI SIAR</h2>
    <table style="border: none; border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>Nama Client</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">{{ $namaClient }}</td>
            </tr>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>Nama Iklan</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">{{ $namaIklan }}</td>
            </tr>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>Periode</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">OD-{{ $idIklan }}</td>
            </tr>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>No Order</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">{{ formatTanggal($mulai) }} s/d {{ formatTanggal($selesai) }}</td>
            </tr>
            <tr>
                <td style="border: none; padding-left: 0px;" width="20%"><strong>Jumlah Putar</strong></td>
                <td style="border: none;" width="2%">:</td>
                <td style="border: none;">{{ $jmlPutar }}</td>
            </tr>
        </tbody>
    </table>
    <table>
        <thead>
            <tr>
                <th style="text-align: center" width="5%">NO</th>
                <th style="text-align: center">TANGGAL</th>
                <th style="text-align: center">JAM PEMUTARAN</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rancanganSiar as $index => $rs)
                <tr>
                    <td style="text-align: center">{{ $index + 1 }}</td>
                    {{-- <td>{{ \Carbon\Carbon::parse($rs->tanggalRs->tanggal)->format('d-m-Y') }}</td> --}}
                    <td>{{ formatHari($rs->tanggal_rs->tanggal) }}</td>
                    <td>{{ formatMenit($rs->menit_putar) ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p style="text-indent: 30px; margin-top: 20px">Dari bukti pemutaran di atas, dengan demikian pemutaran iklan atas
        orderan yang disepakati telah terputar dan terpenuhi. Terima kasih.</p>
    <div style="margin-top: 50px; width: 100%;">
        <div style="width: 50%; float: left;">
            <p style="margin: 0;">Hormat kami,</p>
        </div>
        <br><br><br>
        <div style="width: 50%; float: right; text-align: right;">
            <p style="margin: 0;">TRAFFIC UTY FM MEDARI</p>
            <br><br><br>
            <p style="margin: 0; font-weight: bold; text-decoration: underline;">CITRA</p>
        </div>
    </div>
</body>

</html>
