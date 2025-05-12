@extends('layouts.app')
@section('content')
    <h1>Data Pengantaran</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('createPengantaran') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
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
                            <th>Nama Driver</th>
                            <th>Tanggal</th>
                            <th>Nama Pemesan</th>
                            <th>No.Telp</th>
                            <th>Alamat</th>
                            <th>Ongkos Kirim</th>
                            <th>Status</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengantarans as $pengantaran)
                        <tr>
                            <td>{{ $pengantaran->users->name }}</td>
                            <td class="text-center">
                                <span class="badge badge-info badge-pill">{{ $pengantaran->tanggal }}</span>
                            </td>
                            <td>{{ $pengantaran->nama_pemesan }}</td>
                            <td>{{ $pengantaran->no_telepon }}</td>
                            <td>{{ $pengantaran->alamat }}</td>
                            <td class="text-center">
                                <span class="badge badge-pill badge-primary">{{ number_format($pengantaran->ongkir, 2) }}</span>
                            </td>
                            <td class="text-center">
                                @if ($pengantaran->status === 'Menunggu')
                                    <span class="badge badge-warning badge-pill">{{ $pengantaran->status }}</span>
                                @elseif ($pengantaran->status === 'Selesai')
                                    <span class="badge badge-success badge-pill">{{ $pengantaran->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('showPengantaran', $pengantaran->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                 <!-- Tombol trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $pengantaran->id }}">
                                    Hapus
                                </button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalDelete{{ $pengantaran->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $pengantaran->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Data Pengantaran?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama: <strong>{{ $pengantaran->users->name }}</strong></p>
                                                <p>No HP: <strong>{{ $pengantaran->nohp }}</strong></p>
                                                <p>Alamat: <strong>{{ $pengantaran->alamat }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deletePengantaran', $pengantaran->id) }}" method="POST">
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
