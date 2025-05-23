@extends('layouts.app')

@section('content')
    <h1>Create Data Order</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('order.index') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama Pemesan :
                        </label>
                        <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror" value="{{ old('nama_pemesan') }}">
                        @error('nama_pemesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            No HP Pemesan :
                        </label>
                        <input type="text" name="no_hp_pemesan" class="form-control @error('no_hp_pemesan') is-invalid @enderror" value="{{ old('no_hp_pemesan') }}">
                        @error('no_hp_pemesan   ')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-12 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Alamat :
                        </label>
                        <input type="text" name="alamat_pengantaran" class="form-control @error('alamat_pengantaran') is-invalid @enderror" value="{{ old('alamat_pengantaran') }}">
                        @error('alamat_pengantaran')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-12 mb-2">
                        <label class="form-label">
                            Pilih Driver :
                        </label>
                        <select name="driver_id" class="form-control @error('driver_id') is-invalid @enderror">
                            <option value="">-- Tidak ada driver --</option>
                            @foreach ($user as $driver)
                                <option value="{{ $driver->id }}" {{ old('driver_id') == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('driver_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <hr>
                <h5>Detail Pesanan</h5>
                <div id="detail-container">
                    <div class="row mb-2">
                        <div class="col-xl-12">
                            <label class="form-label">
                                <span class="text-danger">*</span> Pesanan :
                            </label>
                            <input type="text" name="pesanan[]" class="form-control @error('pesanan.0') is-invalid @enderror">
                            @error('pesanan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addDetail()">
                    <i class="fas fa-plus"></i> Tambah Pesanan
                </button>

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
