@extends('layouts.app')

@section('content')
    <h1>Edit Data Order</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('order.index') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('order.update', $order->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Nama Pemesan :
                        </label>
                        <input type="text" name="nama_pemesan" class="form-control @error('nama_pemesan') is-invalid @enderror" value="{{ old('nama_pemesan', $order->nama_pemesan) }}">
                        @error('nama_pemesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            No HP Pemesan :
                        </label>
                        <input type="text" name="no_hp_pemesan" class="form-control @error('no_hp_pemesan') is-invalid @enderror" value="{{ old('no_hp_pemesan', $order->no_hp_pemesan) }}">
                        @error('no_hp_pemesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-12 mb-2">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Alamat :
                        </label>
                        <input type="text" name="alamat_pengantaran" class="form-control @error('alamat_pengantaran') is-invalid @enderror" value="{{ old('alamat_pengantaran', $order->alamat_pengantaran) }}">
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
                                <option value="{{ $driver->id }}" {{ old('driver_id', $order->driver_id) == $driver->id ? 'selected' : '' }}>
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
                    @foreach ($order->orderDetails as $index => $detail)
                        <div class="row mb-2">
                            <div class="col-xl-8">
                                <label class="form-label">
                                    <span class="text-danger">*</span> Pesanan :
                                </label>
                                <input type="text" name="pesanan[]" class="form-control" value="{{ old("pesanan.$index", $detail->pesanan) }}">
                            </div>
                            <div class="col-xl-4">
                                <label class="form-label">
                                    <span class="text-danger">*</span> Harga :
                                </label>
                                <input type="number" step="0.01" name="harga[]" class="form-control" value="{{ old("harga.$index", $detail->harga) }}">
                            </div>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addDetail()">
                    <i class="fas fa-plus"></i> Tambah Pesanan
                </button>

                <br>
                <div class="d-flex">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addDetail() {
            const container = document.getElementById('detail-container');
            const index = container.children.length;

            const row = document.createElement('div');
            row.classList.add('row', 'mb-2');

            row.innerHTML = `
                <div class="col-xl-8">
                    <input type="text" name="pesanan[]" class="form-control" placeholder="Pesanan ke-${index + 1}">
                </div>
                <div class="col-xl-4">
                    <input type="number" step="0.01" name="harga[]" class="form-control" placeholder="Harga">
                </div>
            `;

            container.appendChild(row);
        }
    </script>
@endsection
