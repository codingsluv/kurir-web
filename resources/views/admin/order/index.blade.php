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

                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $order->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal per user -->
                                <div class="modal fade" id="modalDelete{{ $order->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $order->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Hapus Data User?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nama Pemesan: <strong>{{ $order->nama_pemesan }}</strong></p>
                                        <p>No HP Pemesan: <strong>{{ $order->no_hp_pemesan }}</strong></p>
                                        <p>Alamat Pengantaran: <strong>{{ $order->alamat_pengantaran }}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('order.destroy', $order->id) }}" method="POST">
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