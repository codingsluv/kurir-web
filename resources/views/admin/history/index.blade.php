@extends('layouts.app')
@section('content')
    <h1>Data History</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <i class="fas fa-history"></i>
                History
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama</th>
                            <th>Bulan</th>
                            <th>Jmlh.Pengantaran</th>
                            <th>Total Ongkir</th>
                            <th>Gaji Driver</th>
                            <th>Pendapatan Aplikasi</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>Maret</td>
                            <td>150</td>
                            <td>50rb</td>
                            <td>300rb</td>
                            <td>
                                <span class="badge badge-success">10rb</span>
                            </td>

                            <td>
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm">Hapus</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
