@extends('layouts.app')

@section('content')
    <h1>Buat Data Pengantaran</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('pengantaran') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('storePengantaran') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="pesanan_id" class="form-label">
                            <span class="text-danger">*</span> Pilih Pesanan:
                        </label>
                        <select name="pesanan_id" id="pesanan_id"
                            class="form-control @error('pesanan_id') is-invalid @enderror" required>
                            <option selected disabled>-- Pilih Pesanan --</option>
                            @foreach ($pesanans as $pesanan)
                                <option value="{{ $pesanan->id }}"
                                    {{ old('pesanan_id') == $pesanan->id ? 'selected' : '' }}>
                                    ID: {{ $pesanan->id }} - {{ $pesanan->nama_pemesan }}
                                    ({{ $pesanan->alamat }})
                                </option>
                            @endforeach
                        </select>
                        @error('pesanan_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">
                            Pilih Driver:
                        </label>
                        <select name="user_id" id="user_id"
                            class="form-control @error('user_id') is-invalid @enderror">
                            <option selected disabled>-- Pilih Driver --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                    {{ $user->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal_pengiriman" class="form-label">
                            Tanggal Pengiriman:
                        </label>
                        <input type="datetime-local" name="tanggal_pengiriman" id="tanggal_pengiriman"
                            class="form-control @error('tanggal_pengiriman') is-invalid @enderror"
                            value="{{ old('tanggal_pengiriman') }}">
                        @error('tanggal_pengiriman')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="status_pengantaran" class="form-label">
                            <span class="text-danger">*</span> Status:
                        </label>
                        <select name="status_pengantaran" id="status_pengantaran"
                            class="form-control @error('status_pengantaran') is-invalid @enderror" required>
                            <option selected disabled>-- Pilih Status --</option>
                            <option value="Menunggu" {{ old('status_pengantaran') == 'Menunggu' ? 'selected' : '' }}>Menunggu
                            </option>
                            <option value="Dijemput" {{ old('status_pengantaran') == 'Dijemput' ? 'selected' : '' }}>Dijemput
                            </option>
                            <option value="Dikirim" {{ old('status_pengantaran') == 'Dikirim' ? 'selected' : '' }}>Dikirim
                            </option>
                            <option value="Selesai" {{ old('status_pengantaran') == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                            <option value="Gagal" {{ old('status_pengantaran') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                        </select>
                        @error('status_pengantaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tarif_driver" class="form-label">
                            Tarif Driver (Rp):
                        </label>
                        <input type="number" name="tarif_driver" id="tarif_driver"
                            class="form-control @error('tarif_driver') is-invalid @enderror"
                            value="{{ old('tarif_driver') }}">
                        @error('tarif_driver')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>


                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Pengantaran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
