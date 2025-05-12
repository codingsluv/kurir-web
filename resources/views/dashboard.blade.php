@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Pengantaran Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalPengantaranHariIni }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Pendapatan Hari Ini
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPendapatanHariIni, 0, ',', '.') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Status Pengantaran</h6>
                    <div class="row">
                        @foreach ($statusPengantaran as $status)
                            <div class="col-md-6">
                                <div class="mb-2">
                                    <span class="font-weight-bold">{{ $status->status }}:</span>
                                    <span class="text-gray-800">{{ $status->jumlah }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{--  <div>
                        <canvas id="statusPengantaranChart"></canvas>
                    </div>  --}}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Performa Driver</h6>
                    <ul class="list-group">
                        @foreach ($performaDriver as $driver)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $driver->name }}
                                <span class="badge badge-primary badge-pill">{{ $driver->total_pengantaran }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Lokasi Pengantaran Terbaru</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pemesan</th>
                                    <th>Alamat</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lokasiPengantaranTerbaru as $key => $pengantaran)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $pengantaran->nama_pemesan }}</td>
                                        <td>{{ $pengantaran->alamat }}</td>
                                        <td>{{ $pengantaran->tanggal }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Pertumbuhan Pengguna (6 Bulan Terakhir)</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Bulan</th>
                                    <th>Jumlah Pengguna</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertumbuhanPengguna as $pengguna)
                                    <tr>
                                        <td>{{ $pengguna->bulan }}</td>
                                        <td>{{ $pengguna->jumlah_pengguna }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

      <div class="row">
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card shadow h-100 py-2">
                <div class="card-body">
                    <h6 class="m-0 font-weight-bold text-primary mb-3">Peringatan Pengantaran Terlambat</h6>
                    @if ($peringatanPengantaranTerlambat->count() > 0)
                        <div class="alert alert-danger">
                            <ul class="list-group">
                                @foreach ($peringatanPengantaranTerlambat as $pengantaran)
                                    <li class="list-group-item">
                                        Pengantaran <strong>{{ $pengantaran->nama_pemesan }}</strong> pada tanggal <strong>{{ $pengantaran->tanggal }}</strong> belum selesai.
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p class="text-gray-500">Tidak ada pengantaran yang terlambat.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{--  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const statusPengantaranData = {
            labels: [
                @foreach ($statusPengantaran as $status)
                    '{{ $status->status }}',
                @endforeach
            ],
            datasets: [{
                label: 'Jumlah Pengantaran',
                data: [
                    @foreach ($statusPengantaran as $status)
                        {{ $status->jumlah }},
                    @endforeach
                ],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                ],
                borderWidth: 1,
            }]
        };

        const statusPengantaranChartCtx = document.getElementById('statusPengantaranChart').getContext('2d');
        const statusPengantaranChart = new Chart(statusPengantaranChartCtx, {
            type: 'pie',
            data: statusPengantaranData,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            },
        });
    </script>  --}}
@endsection
