@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    @if (Auth::user()->role == 'Admin')
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Driver</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDriver }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                    Total Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Gaji Driver
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            Rp{{ number_format($totalGajiDriver, 0, ',', '.') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
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
                        @if (isset($pertumbuhanPengguna) && $pertumbuhanPengguna->count() > 0)
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
                        @else
                            <p class="text-gray-500">Tidak ada data pertumbuhan pengguna.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @elseif (Auth::user()->role == 'Driver')
        <div class="row">
            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Ongkir</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($total_ongkir_driver, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-truck fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Gaji Anda</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    Rp {{ number_format($gaji_driver, 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-money-bill-wave fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Order Diantar Hari Ini</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $jumlah_order_hari_ini }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <div class="card shadow h-100 py-2">
                    <div class="card-body">
                        <h6 class="m-0 font-weight-bold text-primary mb-3">Order yang Harus Diantar</h6>
                        @if (count($order_yang_harus_diantar) > 0)
                            <ul class="list-group">
                                @foreach ($order_yang_harus_diantar as $order)
                                    <li class="list-group-item">
                                        Order ID: {{ $order->id }}, Alamat: {{ $order->alamat_pengantaran }},
                                        Status: {{ $order->status }}
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="text-gray-500">Tidak ada order yang harus diantar saat ini.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
