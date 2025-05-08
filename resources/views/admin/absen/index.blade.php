@extends('layouts.app')
@section('content')
    <h1>Data Absen</h1>

    <div class="card">
        <div class="card-header">
            <div>
                <a href="{{ route('createAbsen') }}" class="btn btn-sm btn-primary">
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
                            <th>Jam Masuk</th>
                            <th>Jam Pulang</th>
                            <th>Status</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($absens as $absen)
                            <tr>
                                <td>{{ $absen->users ? $absen->users->name : 'No User' }}</td>
                                <td>{{ $absen->tanggal }}</td>
                                <td>{{ $absen->jam_masuk ?? '-' }}</td>
                                <td>{{ $absen->jam_pulang ?? '-' }}</td>
                                <td class="text-center">
                                    @if ($absen->status === 'Izin')
                                        <span class="badge badge-warning badge-pill">{{ $absen->status }}</span>
                                    @elseif ($absen->status === 'Tidak Masuk')
                                        <span class="badge badge-danger badge-pill">{{ $absen->status }}</span>
                                    @else
                                        <span class="badge badge-success badge-pill">{{ $absen->status }}</span>
                                    @endif
                                </td>

                                <td>
                                    <a href="{{ route('showAbsen', $absen->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                     <!-- Tombol trigger modal -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $absen->id }}">
                                        Hapus
                                    </button>
                                    <!-- Modal Hapus -->
                                <div class="modal fade" id="modalDelete{{ $absen->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $absen->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Data Absen?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama: <strong>{{ $absen->users->name }}</strong></p>
                                                <p>Status: <strong>{{ $absen->status }}</strong></p>
                                                <p>Tanggal: <strong>{{ $absen->tanggal }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deleteAbsen', $absen->id) }}" method="POST">
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
