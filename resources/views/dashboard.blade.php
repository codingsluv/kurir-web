@extends('layouts.app')

@section('content')
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

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
@endsection
