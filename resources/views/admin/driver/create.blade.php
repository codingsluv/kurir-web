@extends('layouts.app')

@section('content')
    <h1>Create Data User</h1>

    <div class="card">
        <div class="card-header ">
                <a href="{{ route('driver.index') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
        </div>
        <div class="card-body">
            <form action="{{ route('driver.store') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama :
                        </label>
                        <select name="nama" class="form-control @error('nama')
                            is-invalid
                        @enderror">
                            <option selected disabled>--Pilih Driver--</option>
                            @foreach ($user as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            No HP :
                        </label>
                        <input type="text" name="no_hp" class="form-control @error('no_hp')
                            is-invalid
                        @enderror">
                        @error('no_hp')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Alamat :
                        </label>
                        <input type="text" name="alamat" class="form-control @error('alamat')
                            is-invalid
                        @enderror">
                        @error('alamat')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="d-flex">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
