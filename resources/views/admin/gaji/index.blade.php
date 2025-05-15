@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama Driver</th>
                                <th>Total Ongkir Driver/Pengiriman</th>
                                <th>Gaji Driver (70%)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($gaji_drivers as $data)
                                <tr>
                                    <td>{{ $data['driver']->nama }}</td>
                                    <td>Rp {{ number_format($data['total_ongkir_driver'], 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($data['gaji_driver'], 0, ',', '.') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection