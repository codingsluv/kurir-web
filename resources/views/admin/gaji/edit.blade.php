@extends('layouts.app')

@section('content')
    <h1>Edit Data Gaji</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('gaji') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updateGaji', $gaji->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">
                            <span class="text-danger">*</span> Pilih Driver:
                        </label>
                        <input type="text" class="form-control" value="{{ $gaji->user->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $gaji->user_id }}">
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="bulan" class="form-label">
                            <span class="text-danger">*</span> Bulan (YYYY-MM):
                        </label>
                        <input type="month" name="bulan" id="bulan" class="form-control @error('bulan') is-invalid @enderror" value="{{ old('bulan', $gaji->bulan) }}">
                        @error('bulan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="jumlah_pengantaran" class="form-label">
                            <span class="text-danger">*</span> Jumlah Pengantaran:
                        </label>
                        <input type="number" name="jumlah_pengantaran" id="jumlah_pengantaran" class="form-control @error('jumlah_pengantaran') is-invalid @enderror" value="{{ old('jumlah_pengantaran', $gaji->jumlah_pengantaran) }}">
                        @error('jumlah_pengantaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="total_ongkir" class="form-label">
                            <span class="text-danger">*</span> Total Ongkir:
                        </label>
                        <input type="number" step="0.01" name="total_ongkir" id="total_ongkir" class="form-control @error('total_ongkir') is-invalid @enderror" value="{{ old('total_ongkir', $gaji->total_ongkir) }}">
                        @error('total_ongkir')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
