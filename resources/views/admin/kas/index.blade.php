@extends('layouts.app')
@section('content')
    <h1>Data Kas</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <i class="fas fa-money-check"></i>
                Kas
            </div>
            <div>
                <a href="#" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel mr-2"></i>
                    Excel
                </a>
                <a href="#" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i>
                    PDF
                </a>
                <a href="{{ route('kas.hitung') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-calculator mr-2"></i>
                    Hitung Kas Bulanan
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Bulan</th>
                            <th>Total Ongkir</th>
                            <th>Kas Masuk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kasBulanan as $kas)
                            <tr>
                                <td>{{ $kas->bulan }}</td>
                                <td>Rp. {{ number_format($kas->total_ongkir, 0, ',', '.') }}</td>
                                <td>Rp. {{ number_format($kas->total_kas_masuk, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <a href="{{ route('kas.show', $kas->id) }}" class="btn btn-sm btn-primary">Detail</a>
                                    <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Tidak ada data kas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $kasBulanan->links() }}
            </div>
        </div>
    </div>
@endsection
