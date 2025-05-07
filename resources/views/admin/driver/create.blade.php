@extends('layouts.app')

@section('content')
    <h1>Create Data Driver</h1>

    <div class="card">
        <div class="card-header ">
                <a href="{{ route('driver') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
        </div>
        <div class="card-body">
            <form action="{{ route('storeDriver') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Pilih User :
                        </label>
                        <select name="user_id" class="form-control @error('user_id') is-invalid @enderror">
                            <option selected disabled>--Pilih User--</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            No.Hp :
                        </label>
                        <input type="number" name="nohp" class="form-control @error('nohp')
                            is-invalid
                        @enderror">
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
                        <input type="text" name="alamat" class="form-control @error('alamat')
                            is-invalid
                        @enderror">
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
                        <input type="file" name="foto" class="form-control @error('foto')
                            is-invalid
                        @enderror">
                        @error('foto')
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
