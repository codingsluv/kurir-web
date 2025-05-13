@extends('layouts.app')

@section('content')
    <h1>Edit Pesanan</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('pesanan') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('updatePesanan', $pesanans->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_pemesan" class="form-label">
                                <span class="text-danger">*</span> Nama Pemesan:
                            </label>
                            <input type="text" name="nama_pemesan" id="nama_pemesan"
                                class="form-control @error('nama_pemesan') is-invalid @enderror"
                                value="{{ old('nama_pemesan', $pesanans->nama_pemesan) }}" required>
                            @error('nama_pemesan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="no_telp" class="form-label">
                                <span class="text-danger">*</span> No.Telp:
                            </label>
                            <input type="number" name="no_telp" id="no_telp"
                                class="form-control @error('no_telp') is-invalid @enderror"
                                value="{{ old('no_telp', $pesanans->no_telp) }}" required>
                            @error('no_telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="alamat" class="form-label">
                                <span class="text-danger">*</span> Alamat Tujuan:
                            </label>
                            <input type="text" name="alamat" id="alamat"
                                class="form-control @error('alamat') is-invalid @enderror"
                                value="{{ old('alamat', $pesanans->alamat) }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="total_harga" class="form-label">
                                <span class="text-danger">*</span> Total Harga:
                            </label>
                            <input type="number" name="total_harga" id="total_harga"
                                class="form-control @error('total_harga') is-invalid @enderror"
                                value="{{ old('total_harga', $pesanans->total_harga) }}" required>
                            @error('total_harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                {{-- Bagian untuk Produk --}}
                <div class="card mb-3">
                    <div class="card-header">
                        <span class="text-danger">*</span> Produk yang Dipesan
                    </div>
                    <div class="card-body">
                        <div id="produk-container">
                            {{-- Produk pertama --}}
                            @foreach ($pesanans->produk as $index => $item)
                                <div class="row mb-3 produk-item">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label for="produk_id_{{ $index }}" class="form-label">Produk</label>
                                            <select name="produk[{{ $index }}][id]"
                                                id="produk_id_{{ $index }}"
                                                class="form-control produk-select @error('produk.{{ $index }}.id') is-invalid @enderror"
                                                required>
                                                <option value="">Pilih Produk</option>
                                                @foreach ($products as $product)
                                                    <option value="{{ $product->id }}"
                                                        {{ old('produk.' . $index . '.id', $item->id) == $product->id ? 'selected' : '' }}>
                                                        {{ $product->nama_product }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('produk.' . $index . '.id')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="produk_jumlah_{{ $index }}" class="form-label">Jumlah</label>
                                            <input type="number" name="produk[{{ $index }}][jumlah]"
                                                id="produk_jumlah_{{ $index }}"
                                                class="form-control produk-jumlah @error('produk.{{ $index }}.jumlah') is-invalid @enderror"
                                                value="{{ old('produk.' . $index . '.jumlah', $item->pivot->jumlah) }}"
                                                required min="1">
                                            @error('produk.' . $index . '.jumlah')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                     <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="produk_harga_satuan_{{ $index }}" class="form-label">Harga Satuan</label>
                                            <input type="number" name="produk[{{ $index }}][harga_satuan]"
                                                id="produk_harga_satuan_{{ $index }}"
                                                class="form-control produk-harga_satuan @error('produk.{{ $index }}.harga_satuan') is-invalid @enderror"
                                                value="{{ old('produk.' . $index . '.harga_satuan', $item->pivot->harga_satuan) }}"
                                                min="0">
                                            @error('produk.' . $index . '.harga_satuan')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-danger remove-produk mt-4"
                                            {{ $index == 0 ? 'style="display: none;"' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button type="button" id="tambah-produk" class="btn btn-primary">
                            <i class="fas fa-plus mr-2"></i> Tambah Produk
                        </button>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="status_pemesanan" class="form-label">
                                <span class="text-danger">*</span> Status Pemesanan:
                            </label>
                            <select name="status_pemesanan" id="status_pemesanan"
                                class="form-control @error('status_pemesanan') is-invalid @enderror" required>
                                <option value="">Pilih Status Pemesanan</option>
                                <option value="Belum Dibayar"
                                    {{ old('status_pemesanan', $pesanans->status_pemesanan) == 'Belum Dibayar' ? 'selected' : '' }}>
                                    Belum Dibayar</option>
                                <option value="Sudah Dibayar"
                                    {{ old('status_pemesanan', $pesanans->status_pemesanan) == 'Sudah Dibayar' ? 'selected' : '' }}>
                                    Sudah Dibayar</option>
                            </select>
                            @error('status_pemesanan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let produkCount = document.querySelectorAll('.produk-item').length;

            // Fungsi untuk menambahkan item produk baru
            function tambahProdukItem() {
                const produkItem = document.createElement('div');
                produkItem.className = 'row mb-3 produk-item';
                produkItem.innerHTML = `
                    <div class="col-md-5">
                        <div class="form-group">
                            <label for="produk_id_${produkCount}" class="form-label">Produk</label>
                            <select name="produk[${produkCount}][id]" id="produk_id_${produkCount}" class="form-control produk-select" required>
                                <option value="">Pilih Produk</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->nama_product }}</option>
                                @endforeach
                            </select>
                         </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="produk_jumlah_${produkCount}" class="form-label">Jumlah</label>
                            <input type="number" name="produk[${produkCount}][jumlah]" id="produk_jumlah_${produkCount}" class="form-control produk-jumlah" value="1" required min="1">
                        </div>
                    </div>
                    <div class="col-md-3">
                         <div class="form-group">
                            <label for="produk_harga_satuan_${produkCount}" class="form-label">Harga Satuan</label>
                            <input type="number" name="produk[${produkCount}][harga_satuan]" id="produk_harga_satuan_${produkCount}" class="form-control produk-harga_satuan"  min="0">
                        </div>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-danger remove-produk mt-4">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                `;

                const produkContainer = document.getElementById('produk-container');
                produkContainer.appendChild(produkItem);
                produkCount++;
            }

            // Event listener untuk tombol "Tambah Produk"
            const tambahProdukButton = document.getElementById('tambah-produk');
            tambahProdukButton.addEventListener('click', tambahProdukItem);

            // Event listener untuk tombol "Hapus Produk" (delegated)
            const produkContainer = document.getElementById('produk-container');
            produkContainer.addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-produk')) {
                    event.target.closest('.produk-item').remove();
                }
            });
        });
    </script>
@endsection
