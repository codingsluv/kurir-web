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
                            <th>Nama Driver</th>
                            <th>Tanggal</th>
                            <th>Nama Pemesan</th>
                            <th>No. Telepon</th>
                            <th>Alamat</th>
                            <th>Ongkir</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($history as $history_pengantaran)
                            <tr>
                                <td>{{ $history_pengantaran->user->name }}</td>
                                <td>{{ $history_pengantaran->tanggal }}</td>
                                <td>{{ $history_pengantaran->nama_pemesan }}</td>
                                <td>{{ $history_pengantaran->no_telepon }}</td>
                                <td>{{ $history_pengantaran->alamat }}</td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-info">{{ number_format($history_pengantaran->ongkir, 2) }}</span>
                                </td>
                                <td class="text-center">
                                    @if ($history_pengantaran->status === 'Menunggu')
                                        <span class="badge badge-warning badge-pill">{{ $history_pengantaran->status }}</span>
                                    @elseif ($history_pengantaran->status === 'Selesai')
                                        <span class="badge badge-success badge-pill">{{ $history_pengantaran->status }}</span>
                                    @endif
                                </td>
                                <td>
                                    <form action="#" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
