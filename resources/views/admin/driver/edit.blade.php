@extends('layouts.app')

@section('content')
    <h1>Edit Data Driver</h1>

    <div class="card">
        <div class="card-header bg-warning">
                <a href="{{ route('driver') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updateDriver', $driver->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row mb-2">
                    <div class="col-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama User :
                        </label>
                        <input type="text" class="form-control" value="{{ $driver->user->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $driver->user_id }}">
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            No.Hp :
                        </label>
                        <input type="number" name="nohp" class="form-control @error('nohp') is-invalid @enderror"
                            value="{{ old('nohp', $driver->nohp) }}">
                        @error('nohp')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Alamat :
                        </label>
                        <input type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror"
                            value="{{ old('alamat', $driver->alamat) }}">
                        @error('alamat')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Foto :
                        </label>
                        @if ($driver->foto)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $driver->foto) }}" width="100" alt="Foto Driver">
                            </div>
                        @endif
                        <input type="file" name="foto" class="form-control @error('foto') is-invalid @enderror">
                        @error('foto')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <br>
                <div class="d-flex">
                    <button type="submit" class="btn btn-sm btn-warning">
                        <i class="fas fa-edit mr-2"></i>
                        Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
