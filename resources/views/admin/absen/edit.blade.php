@extends('layouts.app')

@section('content')
    <h1>Edit Data Absen</h1>

    <div class="card">
        <div class="card-header bg-warning">
            <a href="{{ route('absen') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updateAbsen', $absen->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                <div class="col-6 mb-1">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama User :
                        </label>
                        <input type="text" class="form-control" value="{{ $absen->users->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $absen->user_id }}">
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Tanggal:
                        </label>
                        <input value="{{ $absen->tanggal }}"
                         type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" readonly>
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Jam Masuk:
                        </label>
                        <input value="{{ $absen->jam_masuk }}"
                         type="time" name="jam_masuk" class="form-control @error('jam_masuk') is-invalid @enderror" readonly>
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
                        <input value="{{ $absen->jam_pulang }}"
                         type="time" name="jam_pulang" class="form-control @error('jam_pulang') is-invalid @enderror" readonly>
                        @error('jam_pulang')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <span class="text-danger">*</span> Status:
                        </label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option disabled {{ old('status', $absen->status) == null ? 'selected' : '' }}>--Status Kehadiran--</option>
                            <option value="Masuk" {{ old('status', $absen->status) == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Tidak Masuk" {{ old('status', $absen->status) == 'Tidak Masuk' ? 'selected' : '' }}>Tidak Masuk</option>
                            <option value="Izin" {{ old('status', $absen->status) == 'Izin' ? 'selected' : '' }}>Izin</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-warning">
                        <i class="fas fa-edit mr-2"></i> Edit
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
