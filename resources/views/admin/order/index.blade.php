@extends('layouts.app')

@section('content')
    <h1>Data Order</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('order.create') }}" class="btn btn-sm btn-primary">
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
                            <th>Nama Pemesan</th>
                            <th>No HP Pemesan</th>
                            <th>Alamat Pengantaran</th>
                            <th>Status</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->driver->nama }}</td>
                            <td>{{ $order->nama_pemesan }}</td>
                            <td>{{ $order->no_hp_pemesan }}</td>
                            <td>{{ $order->alamat_pengantaran }}</td>
                            <td>
                                @if ($order->status == 'Menunggu')
                                    <span class="badge badge-warning">Menunggu</span>
                                @elseif ($order->status == 'Selesai')
                                    <span class="badge badge-success">Selesai</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('order.edit', $order->id) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('order.destroy', $order->id) }}" class="btn btn-sm btn-danger">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection