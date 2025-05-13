@extends('layouts.app')
@section('content')
    <h1>Data Pesanan</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('createPesanan') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Pesanan
                </a>
            </div>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama Pemesan</th>
                            <th>No.Telp</th>
                            <th>Alamat</th>
                            <th>Total Harga</th>
                            <th>Status Pemesanan</th>
                            <th>Produk</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $pesanan)
                            <tr>
                                <td>{{ $pesanan->nama_pemesan }}</td>
                                <td>{{ $pesanan->no_telp }}</td>
                                <td>{{ $pesanan->alamat }}</td>
                                <td>Rp. {{ number_format($pesanan->total_harga, 0, ',', '.') }}</td>
                                <td>{{ $pesanan->status_pemesanan }}</td>
                                <td>
                                    <ul>
                                        @foreach ($pesanan->produk as $produk)
                                            <li>
                                                {{ $produk->nama_product }} ({{ $produk->pivot->jumlah }}) -
                                                Rp. {{ number_format($produk->pivot->harga_satuan, 0, ',', '.') }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('editPesanan', $pesanan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#modalDelete{{ $pesanan->id }}">
                                        Hapus
                                    </button>

                                    <div class="modal fade" id="modalDelete{{ $pesanan->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="modalDeleteLabel{{ $pesanan->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title">Hapus Data Pesanan?</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Nama Pemesan: <strong>{{ $pesanan->nama_pemesan }}</strong></p>
                                                    <p>No HP: <strong>{{ $pesanan->no_telp }}</strong></p>
                                                    <p>Alamat: <strong>{{ $pesanan->alamat }}</strong></p>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('destroyPesanan', $pesanan->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Batal</button>
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
