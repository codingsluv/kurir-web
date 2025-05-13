@extends('layouts.app')

@section('content')
    <h1>Tambah Product</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('product') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updateProduct', $product->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_product" class="form-label">
                            <span class="text-danger">*</span> Nama Product:
                        </label>
                        <input
                         type="text" name="nama_product" id="nama_product" class="form-control @error('nama_product') is-invalid @enderror" value="{{ $product->nama_product }}" required>
                        @error('nama_product')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="harga" class="form-label">
                            <span class="text-danger">*</span> Harga:
                        </label>
                        <input  type="number" name="harga" id="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ $product->harga }}" required>
                        @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label class="form-label">
                            <span class="text-danger">*</span> Kategori:
                        </label>
                        <select name="kategori" class="form-control @error('kategori') is-invalid @enderror">
                            <option disabled {{ old('kategori', $product->kategori) == null ? 'selected' : '' }}>--Kategori--</option>
                            <option value="Makanan" {{ old('kategori', $product->kategori) == 'Makanan' ? 'selected' : '' }}>Makanan</option>
                            <option value="Barang" {{ old('kategori', $product->kategori) == 'Barang' ? 'selected' : '' }}>Barang</option>
                        </select>
                        @error('kategori')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="deskripsi" class="form-label">
                            <span class="text-danger">*</span> Deskripsi:
                        </label>
                        <textarea name="deskripsi" id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Pesanan
                    </button>
                </div>
            </form>
        </div>
    </div>

    
@endsection
