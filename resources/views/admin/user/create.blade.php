@extends('layouts.app')

@section('content')
    <h1>Create Data User</h1>

    <div class="card">
        <div class="card-header ">
                <a href="{{ route('user') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali
                </a>
        </div>
        <div class="card-body">
            <form action="{{ route('storeUser') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama :
                        </label>
                        <input type="text" name="name" class="form-control @error('name')
                            is-invalid
                        @enderror">
                        @error('name')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Email :
                        </label>
                        <input type="email" name="email" class="form-control @error('email')
                            is-invalid
                        @enderror">
                        @error('email')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-12 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Role :
                        </label>
                        <select name="role" class="form-control @error('role')
                            is-invalid
                        @enderror">
                            <option selected disabled>--Pilih Role--</option>
                            <option value="Admin">Admin</option>
                            <option value="Driver">Driver</option>
                        </select>
                        @error('role')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Password :
                        </label>
                        <input type="password" name="password" class="form-control @error('password')
                            is-invalid
                        @enderror">
                        @error('password')
                            <small class="text-danger">
                                {{ $message }}
                            </small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Konfirmasi Password :
                        </label>
                        <input type="password" name="password_confirmation" class="form-control @error('password')
                            is-invalid
                        @enderror">
                        @error('password')
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
