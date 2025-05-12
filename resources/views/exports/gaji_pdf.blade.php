<!DOCTYPE html>
<html>
<head>
    <title>Laporan Gaji Driver</title>
    <style>
        /* Gaya CSS untuk PDF */
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>Laporan Gaji Driver</h1>
    <table>
        <thead>
            <tr>
                <th>Nama Driver</th>
                <th>Bulan</th>
                <th>Jumlah Pengantaran</th>
                <th>Total Ongkir</th>
                <th>Gaji Driver</th>
                <th>Pendapatan Aplikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataGaji as $gaji)
            <tr>
                <td>{{ $gaji->user->name }}</td>
                <td>{{ $gaji->bulan }}</td>
                <td>{{ $gaji->jumlah_pengantaran }}</td>
                <td>{{ $gaji->total_ongkir }}</td>
                <td>{{ $gaji->gaji_driver }}</td>
                <td>{{ $gaji->pendapatan_aplikasi }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

