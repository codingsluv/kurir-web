@extends('layouts.app')

@section('content')
    <h1>Data User</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <a href="{{ route('createUser') }}" class="btn btn-sm btn-primary">
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
                            <th>Role</th>
                            <th>
                                <i class="fas fa-cog"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $item)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td class="text-center">
                                @if ($item->role == 'Admin')
                                    <span class="badge badge-dark">{{ $item->role }}</span>
                                @else
                                    <span class="badge badge-info">{{ $item->role }}</span>
                                @endif
                            </td>
                            <!-- <td class="text-center">
                                @if ($item->Aktif == true)
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                @endif
                            </td> -->

                            <td>
                                <a href="{{ route('showUser', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                 <!-- Tombol buka modal -->
                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $item->id }}">Hapus</button>

                                <!-- Modal per user -->
                                <div class="modal fade" id="modalDelete{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $item->id }}" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h5 class="modal-title">Hapus Data User?</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Nama: <strong>{{ $item->name }}</strong></p>
                                        <p>Email: <strong>{{ $item->email }}</strong></p>
                                        <p>Role: <strong>{{ $item->role }}</strong></p>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('deleteUser', $item->id) }}" method="POST">
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
