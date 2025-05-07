@extends('layouts.app')
@section('content')
    <h1>Data Pengantaran</h1>
    <div class="card">
        <div class="card-header">
            <div>
                <a href="#" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama Driver</th>
                            <th>Tanggal</th>
                            <th>Nama Pemesan</th>
                            <th>No.Telp</th>
                            <th>Alamat</th>
                            <th>Ket.Ongkir</th>
                            <th>Status</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Tiger Nixon</td>
                            <td>08.00</td>
                            <td>04.00</td>
                            <td>0293298329</td>
                            <td>Gg.Berkah</td>
                            <td>10rb</td>
                            <td>
                                <span class="badge badge-success badge-pill">SELSAI</span>
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
