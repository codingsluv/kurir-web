@extends('layouts.app')

@section('content')
    <h1>Create Data Pengantaran</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('pengantaran') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updatePengantaran', $pengantaran->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Pilih Driver:
                        </label>
                        <input type="text" class="form-control" value="{{ $pengantaran->users->name }}" readonly>
                        <input type="hidden" name="user_id" value="{{ $pengantaran->user_id }}">
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Tanggal:
                        </label>
                        <input type="date" value="{{ $pengantaran->tanggal }}"
                         name="tanggal" class="form-control @error('tanggal') is-invalid @enderror">
                        @error('tanggal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">
                            <span class="text-danger">*</span> Nama Pemesan:
                        </label>
                        <input value="{{ $pengantaran->nama_pemesan }}"
                         type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror">
                        @error('nama_pemesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="form-label">
                            <span class="text-danger">*</span> No.Telp:
                        </label>
                        <input value="{{ $pengantaran->no_telepon }}"
                         type="number" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror">
                        @error('no_telepon')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">
                            <span class="text-danger">*</span> Status:
                        </label>
                        <select name="status" class="form-control @error('status') is-invalid @enderror">
                            <option selected disabled>--Status Pengantaran--</option>
                            <option value="Selesai" {{ $pengantaran->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="Menunggu" {{ $pengantaran->status == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">
                            <span class="text-danger">*</span> Alamat:
                        </label>
                        <input value="{{ $pengantaran->alamat }}"
                         type="text" name="alamat" class="form-control @error('alamat') is-invalid @enderror">
                        @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">
                            <span class="text-danger">*</span> Catatan:
                        </label>
                        <textarea type="text" name="catatan" class="form-control @error('catatan') is-invalid @enderror"></textarea>
                        @error('catatan')
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
