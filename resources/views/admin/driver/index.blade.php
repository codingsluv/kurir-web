@extends('layouts.app')

@section('content')
    <h1>Data Driver</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('createDriver') }}" class="btn btn-sm btn-primary">
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
                            <th>No.</th>
                            <th>Nama</th>
                            <th>No.Hp</th>
                            <th>Alamat</th>
                            <th>Foto</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $index => $driver)
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $driver->user->name }}</td>
                            <td>{{ $driver->nohp }}</td>
                            <td>{{ $driver->alamat }}</td>
                            <td>
                                @if ($driver->foto)
                                    <img src="{{ asset('storage/' . $driver->foto) }}" width="60" height="60" alt="Foto Driver">
                                @else
                                    🙎
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('showDriver', $driver->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <!-- Tombol trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $driver->id }}">
                                    Hapus
                                </button>

                                <!-- Modal Hapus -->
                                <div class="modal fade" id="modalDelete{{ $driver->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $driver->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Data Driver?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama: <strong>{{ $driver->user->name }}</strong></p>
                                                <p>No HP: <strong>{{ $driver->nohp }}</strong></p>
                                                <p>Alamat: <strong>{{ $driver->alamat }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deleteDriver', $driver->id) }}" method="POST">
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
