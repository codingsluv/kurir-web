@extends('layouts.app')

@section('content')
    <h1>Data Driver</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
                <!-- <a href="{{ route('driver.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a> -->
                <i class="fas fa-user"></i>
                <span>Data Driver   </span>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama Driver</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <!-- <th>
                                <i class="fas fa-cog"></i>
                            </th> -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $driver)
                        <tr>
                            <td>{{ $driver->nama }}</td>
                            <td>{{ $driver->no_hp }}</td>
                            <td>{{ $driver->alamat }}</td>


                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection