@extends('layouts.app')

@section('content')
    <h1>Create Data Absen</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('absen') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('storeAbsen') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Pilih User:
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
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Tanggal:
                        </label>
                        <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jam Masuk:
                        </label>
                        <input type="time" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror">
                        @error('jam_masuk')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jam Pulang:
                        </label>
                        <input type="time" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror">
                        @error('jam_pulang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <span class="text-danger">*</span> Status:
                        </label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option selected disabled>--Status Kehadiran--</option>
                            <option value="Masuk">Masuk</option>
                            <option value="Tidak Masuk">Tidak Masuk</option>
                            <option value="Izin">Izin</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
