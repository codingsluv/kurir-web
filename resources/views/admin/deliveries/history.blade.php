@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">
            <i class="fas fa-history"></i>
            {{ $title }}
        </h1>

        <div class="card shadow mb-4">
            <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
                <div class="d-flex justify-content-end mb-4">
                    <form method="GET" action="{{ route('export.order.excel') }}" style="display: inline-block;">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-file-excel"></i>
                            Excel
                        </button>
                    </form>
                    <form method="GET" action="{{ route('export.order.pdf') }}" style="display: inline-block; margin-left: 10px;">
                        <button type="submit" class="btn btn-danger">
                            <i class="fas fa-file-pdf"></i>
                            PDF
                        </button>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Driver</th>
                                <th>Nama Pemesan</th>
                                <th>Alamat Pengantaran</th>
                                <th>Tanggal Pengantaran</th>
                                <th>Total Ongkir</th>
                                <th>Jenis Pembayaran</th>
                                <th>Status Pengantaran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($deliveries as $key => $delivery)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $delivery->driver->nama }}</td> {{-- Asumsi ada relasi antara Order dan User (Driver) --}}
                                    <td>{{ $delivery->nama_pemesan }}</td>
                                    <td>{{ $delivery->alamat_pengantaran }}</td>
                                    <td>{{ $delivery->created_at }}</td> {{-- Tanggal order dibuat --}}
                                    <td>{{ $delivery->delivery->total_ongkir ?? '-' }}</td> {{-- Akses data ongkir melalui relasi --}}
                                    <td class="text-center">
                                        <span class="badge badge-pill badge-info">{{ $delivery->delivery->jenis_pembayaran ?? '-' }}</span>
                                    </td>
                                     <td class="text-center">
                                        <span class="badge badge-pill badge-success">{{ $delivery->delivery->status_pengantaran ?? '-' }}</span>
                                     </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
