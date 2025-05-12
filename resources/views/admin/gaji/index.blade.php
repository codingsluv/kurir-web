@extends('layouts.app')
@section('content')
    <h1>Data Gaji</h1>
    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('createGaji') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </div>
            <div>
                <a href="{{ route('export.gaji') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-file-excel mr-2"></i>
                    Exel
                </a>
                <a href="{{ route('export.gaji.pdf') }}" class="btn btn-sm btn-danger">
                    <i class="fas fa-file-pdf mr-2"></i>
                    PDF
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

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
                        @foreach ($gajis as $gaji)
                        <tr>
                            <td>{{ $gaji->user->name }}</td>
                            <td>{{ $gaji->bulan }}</td>
                            <td class="text-center">{{ $gaji->jumlah_pengantaran }}</td>
                            <td class="text-center">{{ number_format($gaji->total_ongkir, 2) }}</td>
                            <td class="text-center">{{ number_format($gaji->gaji_driver, 2) }}</td>
                            <td class="text-center">
                                <span class="badge badge-success">{{ number_format($gaji->pendapatan_aplikasi, 2) }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('showGaji', $gaji->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <!-- Tombol trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $gaji->id }}">
                                    Hapus
                                </button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalDelete{{ $gaji->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $gaji->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Data Gaji?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">

                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deleteGaji', $gaji->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
