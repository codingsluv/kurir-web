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
