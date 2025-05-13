@extends('layouts.app')

@section('content')
    <h1>Buat Pesanan Baru</h1>

    <div class="card">
        <div class="card-header bg-success text-white">
            <a href="{{ route('pesanan') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('storePesanan') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="nama_pemesan" class="form-label">
                            <span class="text-danger">*</span> Nama Pemesan:
                        </label>
                        <input type="text" name="nama_pemesan" id="nama_pemesan"
                            class="form-control @error('nama_pemesan') is-invalid @enderror"
                            value="{{ old('nama_pemesan') }}" required>
                        @error('nama_pemesan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="no_telp" class="form-label">
                            <span class="text-danger">*</span> No.Telp:
                        </label>
                        <input type="number" name="no_telp" id="no_telp"
                            class="form-control @error('no_telp') is-invalid @enderror" value="{{ old('no_telp') }}"
                            required>
                        @error('no_telp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="alamat" class="form-label">
                            <span class="text-danger">*</span> Alamat Tujuan:
                        </label>
                        <input type="text" name="alamat" id="alamat"
                            class="form-control @error('alamat') is-invalid @enderror" value="{{ old('alamat') }}"
                            required>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="total_harga" class="form-label">
                            <span class="text-danger">*</span> Total Harga:
                        </label>
                        <input type="number" name="total_harga" id="total_harga"
                            class="form-control @error('total_harga') is-invalid @enderror"
                            value="{{ old('total_harga', 0) }}" required readonly>
                        @error('total_harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Bagian untuk Produk --}}
                <div class="card mb-3">
                    <div class="card-header bg-info text-white">
                        <span class="text-danger">*</span> Produk yang Dipesan
                    </div>
                    <div class="card-body">
                        <div id="produk-container">
                            {{-- Produk pertama --}}
                            <div class="row mb-3 produk-item">
                                <div class="col-md-5">
                                    <label for="produk_id_0" class="form-label">Produk</label>
                                    <select name="produk[0][id]" id="produk_id_0"
                                        class="form-control produk-select @error('produk.0.id') is-invalid @enderror"
                                        required>
                                        <option value="">Pilih Produk</option>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}"
                                                {{ old('produk.0.id') == $product->id ? 'selected' : '' }}>
                                                {{ $product->nama_product }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('produk.0.id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="produk_jumlah_0" class="form-label">Jumlah</label>
                                    <input type="number" name="produk[0][jumlah]" id="produk_jumlah_0"
                                        class="form-control produk-jumlah @error('produk.0.jumlah') is-invalid @enderror"
                                        value="{{ old('produk.0.jumlah', 1) }}" required min="1">
                                    @error('produk.0.jumlah')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3">
                                    <label for="produk_harga_satuan_0" class="form-label">Harga Satuan</label>
                                    <input type="number" name="produk[0][harga_satuan]" id="produk_harga_satuan_0"
                                        class="form-control produk-harga_satuan @error('produk.0.harga_satuan') is-invalid @enderror"
                                        value="{{ old('produk.0.harga_satuan') }}" min="0" readonly>
                                    @error('produk.0.harga_satuan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-danger remove-produk mt-4"
                                        style="display: none;">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="tambah-produk" class="btn btn-sm btn-info">
                            <i class="fas fa-plus mr-2"></i> Tambah Produk
                        </button>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="status_pemesanan" class="form-label">
                            <span class="text-danger">*</span> Status Pemesanan:
                        </label>
                        <select name="status_pemesanan" id="status_pemesanan"
                            class="form-control @error('status_pemesanan') is-invalid @enderror" required>
                            <option value="">Pilih Status Pemesanan</option>
                            <option value="Belum Dibayar" {{ old('status_pemesanan') == 'Belum Dibayar' ? 'selected' : '' }}>
                                Belum Dibayar</option>
                            <option value="Sudah Dibayar" {{ old('status_pemesanan') == 'Sudah Dibayar' ? 'selected' : '' }}>
                                Sudah Dibayar</option>
                        </select>
                        @error('status_pemesanan')
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let produkCount = 1;
  
            // Fungsi untuk menambahkan item produk baru
            function tambahProdukItem() {
                const produkItem = document.createElement('div');
                produkItem.className = 'row mb-3 produk-item';
                produkItem.innerHTML = `
                    <div class="col-md-5">
                        <label for="produk_id_${produkCount}" class="form-label">Produk</label>
                        <select name="produk[${produkCount}][id]" id="produk_id_${produkCount}" class="form-control produk-select" required>
                            <option value="">Pilih Produk</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->nama_product }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="produk_jumlah_${produkCount}" class="form-label">Jumlah</label>
                        <input type="number" name="produk[${produkCount}][jumlah]" id="produk_jumlah_${produkCount}" class="form-control produk-jumlah" value="1" required min="1">
                    </div>
                    <div class="col-md-3">
                        <label for="produk_harga_satuan_${produkCount}" class="form-label">Harga Satuan</label>
                        <input type="number" name="produk[${produkCount}][harga_satuan]" id="produk_harga_satuan_${produkCount}" class="form-control produk-harga_satuan"  min="0" readonly>
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

                // Inisialisasi event listener untuk elemen baru
                initializeEventListeners();
            }

            function initializeEventListeners() {
                // Event listener untuk tombol "Tambah Produk"
                const tambahProdukButton = document.getElementById('tambah-produk');
                tambahProdukButton.addEventListener('click', tambahProdukItem);

                // Event listener untuk tombol "Hapus Produk" (delegated)
                const produkContainer = document.getElementById('produk-container');
                produkContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-produk')) {
                        event.target.closest('.produk-item').remove();
                        updateTotalHarga(); // Update total harga setelah menghapus produk
                    }
                });

                // Event listener untuk select produk (delegated)
                produkContainer.addEventListener('change', function(event) {
                    if (event.target.classList.contains('produk-select')) {
                        const produkId = event.target.value;
                        const hargaSatuanInput = event.target.closest('.produk-item').querySelector('.produk-harga_satuan');

                        // Cari harga produk dari data yang tersedia (misalnya, dari variabel PHP yang diteruskan ke view)
                        const produkData = {
                            @foreach ($products as $product)
                                "{{ $product->id }}": "{{ $product->harga }}",
                            @endforeach
                        };

                        if (produkData[produkId] !== undefined) {
                            hargaSatuanInput.value = produkData[produkId];
                            updateTotalHarga(); // Update total harga ketika produk dipilih
                        } else {
                            hargaSatuanInput.value = 0;
                            updateTotalHarga();
                        }
                    }
                });

                // Event listener untuk input jumlah produk (delegated)
                produkContainer.addEventListener('input', function(event) {
                    if (event.target.classList.contains('produk-jumlah')) {
                        updateTotalHarga();
                    }
                });
            }

            function updateTotalHarga() {
                let totalHarga = 0;
                const produkItems = document.querySelectorAll('.produk-item');

                produkItems.forEach(item => {
                    const hargaSatuanInput = item.querySelector('.produk-harga_satuan');
                    const jumlahInput = item.querySelector('.produk-jumlah');
                    const hargaSatuan = parseFloat(hargaSatuanInput.value) || 0;
                    const jumlah = parseInt(jumlahInput.value) || 0;

                    totalHarga += hargaSatuan * jumlah;
                });

                const totalHargaInput = document.getElementById('total_harga');
                totalHargaInput.value = totalHarga;
            }
            initializeEventListeners();
            updateTotalHarga();
        });
    </script>
@endsection
