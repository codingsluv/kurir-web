@extends('layouts.app')

@section('content')
    <h1>
        <i class="fas fa-shopping-cart"></i>
        {{ $title }}
    </h1>

    @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Pesanan berhasil diantar!
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama Pemesan</th>
                            <th>No HP Pemesan</th>
                            <th>Alamat Pengantaran</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order->nama_pemesan }}</td>
                                <td>{{ $order->no_hp_pemesan }}</td>
                                <td>{{ $order->alamat_pengantaran }}</td>
                                <td class="text-center">
                                    @if ($order->status == 'Menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif ($order->status == 'Selesai')
                                        <span class="badge badge-success">Selesai</span>
                                    @endif
                                </td>
                                 <td class="text-center">
                                    @if ($order->status == 'Menunggu')
                                         @if ($order->delivery)
                                            <a href="{{ route('driver.deliveries.show', $order->id) }}" class="btn btn-sm btn-success">
                                                <i class="fas fa-truck"></i>
                                                Lihat Detail Pengantaran
                                            </a>
                                        @else
                                            <a href="{{ route('driver.deliveries.show', $order->id) }}" class="btn btn-sm btn-primary">
                                                 <i class="fas fa-truck"></i>
                                                Lakukan Pengantaran
                                            </a>
                                        @endif
                                    @else
                                        <span>Pengantaran Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
