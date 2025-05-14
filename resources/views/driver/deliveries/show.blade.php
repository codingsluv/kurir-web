
@extends('layouts.app')

@section('content')
    <h1>Isi Data Pengantaran</h1>

    <div class="card">
        <div class="card-header">
            <a href="{{ route('order.index') }}" class="btn btn-sm btn-success">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
        <div class="card-body">
            <form action="{{ route('driver.deliveries.update', $order->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            Nama Pemesan:
                        </label>
                        <input type="text" class="form-control" value="{{ $order->nama_pemesan }}" readonly>
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            Alamat Pengantaran:
                        </label>
                        <input type="text" class="form-control" value="{{ $order->alamat_pengantaran }}" readonly>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            No. HP Pemesan:
                        </label>
                        <input type="text" class="form-control" value="{{ $order->no_hp_pemesan }}" readonly>
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Total Ongkir:
                        </label>
                        <input type="number" name="total_ongkir" id="total_ongkir"
                               value="{{ old('total_ongkir', $order->delivery->total_ongkir ?? '') }}" required
                               class="form-control @error('total_ongkir') is-invalid @enderror">
                        @error('total_ongkir')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Jenis Pembayaran:
                        </label>
                        <select name="jenis_pembayaran" id="jenis_pembayaran" required
                                class="form-control @error('jenis_pembayaran') is-invalid @enderror">
                            <option value="" disabled selected>--Pilih Jenis Pembayaran--</option>
                            <option
                                value="cash" {{ old('jenis_pembayaran', $order->delivery->jenis_pembayaran ?? '') == 'cash' ? 'selected' : '' }}>
                                Cash
                            </option>
                            <option
                                value="transfer" {{ old('jenis_pembayaran', $order->delivery->jenis_pembayaran ?? '') == 'transfer' ? 'selected' : '' }}>
                                Transfer
                            </option>
                        </select>
                        @error('jenis_pembayaran')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-xl-6">
                        <label class="form-label">
                            <span class="text-danger">*</span>
                            Jenis Orderan:
                        </label>
                        <select name="jenis_orderan" id="jenis_orderan" required
                                class="form-control @error('jenis_orderan') is-invalid @enderror">
                            <option value="" disabled selected>--Pilih Jenis Orderan--</option>
                            <option
                                value="B-F" {{ old('jenis_orderan', $order->delivery->jenis_orderan ?? '') == 'B-F' ? 'selected' : '' }}>
                                B-F
                            </option>
                            <option
                                value="B-M" {{ old('jenis_orderan', $order->delivery->jenis_orderan ?? '') == 'B-M' ? 'selected' : '' }}>
                                B-M
                            </option>
                            <option
                                value="B-J" {{ old('jenis_orderan', $order->delivery->jenis_orderan ?? '') == 'B-J' ? 'selected' : '' }}>
                                B-J
                            </option>
                            <option
                                value="B-P" {{ old('jenis_orderan', $order->delivery->jenis_orderan ?? '') == 'B-P' ? 'selected' : '' }}>
                                B-P
                            </option>
                            <option
                                value="B-PP" {{ old('jenis_orderan', $order->delivery->jenis_orderan ?? '') == 'B-PP' ? 'selected' : '' }}>
                                B-PP
                            </option>
                            </select>
                        @error('jenis_orderan')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-2">
                     <div class="col-xl-12">
                        <label class="form-label">
                            Bukti Transfer (Jika Transfer):
                        </label>
                        <input type="file" name="bukti_transfer" id="bukti_transfer" accept="image/*"
                               class="form-control @error('bukti_transfer') is-invalid @enderror">
                        @if ($order->delivery && $order->delivery->bukti_transfer)
                            <p class="text-muted text-xs mt-1">
                                File saat ini: {{ $order->delivery->bukti_transfer }}
                            </p>
                            <img
                                src="{{ asset('storage/bukti_transfer/' . $order->delivery->bukti_transfer) }}"
                                alt="Bukti Transfer" class="mt-2 rounded" style="max-width: 200px;">
                        @endif
                        @error('bukti_transfer')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <hr>
                <h5>Detail Pesanan</h5>
                <div id="detail-container">
                    @if(isset($order->orderDetails) && count($order->orderDetails) > 0)
                        @foreach($order->orderDetails as $index => $detail)
                            <div class="row mb-2 cloned-row">
                                <div class="col-xl-8">
                                    <label class="form-label">
                                        Pesanan :
                                    </label>
                                     <input type="text"  class="form-control "
                                           name="pesanan[{{$index}}]"  value="{{  $detail->pesanan }}" readonly>

                                </div>
                                <div class="col-xl-4">
                                    <label class="form-label">
                                        <span class="text-danger">*</span>
                                        Harga :
                                    </label>
                                    <input type="number" step="0.01" name="harga[{{$index}}]"
                                           class="form-control @error('harga.{{$index}}') is-invalid @enderror"
                                           value="{{ old('harga.' . $index, $detail->harga) }}" required>
                                    @error('harga.{{$index}}')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                 <div class="col-xl-2">
                                        <button type="button" class="btn btn-sm btn-danger remove-detail-row" onclick="removeDetail(this)">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                </div>
                            </div>
                        @endforeach
                    @else
                         <div class="row mb-2 cloned-row">
                            <div class="col-xl-8">
                                 <label class="form-label">
                                        Pesanan :
                                    </label>
                                <input type="text" name="pesanan[0]" class="form-control" placeholder="Nama Pesanan" readonly>
                            </div>
                            <div class="col-xl-4">
                                <label class="form-label">
                                     <span class="text-danger">*</span>
                                    Harga :
                                </label>
                                <input type="number" step="0.01" name="harga[0]" class="form-control"  required>
                            </div>
                             <div class="col-xl-2">
                                <button type="button" class="btn btn-sm btn-danger remove-detail-row" onclick="removeDetail(this)">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                         </div>
                    @endif
                </div>

                <button type="button" class="btn btn-sm btn-secondary mb-3" onclick="addDetail()">
                    <i class="fas fa-plus"></i> Tambah Pesanan
                </button>


                <div class="row mb-2">
                    <div class="col-xl-12">
                        <label class="form-label">
                            Catatan Driver:
                        </label>
                        <textarea name="catatan_driver" id="catatan_driver"
                                  class="form-control @error('catatan_driver') is-invalid @enderror">{{ old('catatan_driver', $order->delivery->catatan_driver ?? '') }}</textarea>
                        @error('catatan_driver')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <br>
                <div class="d-flex">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Simpan Data Pengantaran
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
        row.classList.add('row', 'mb-2', 'cloned-row');

        row.innerHTML = `
            <div class="col-xl-8">
                <label class="form-label">
                    Pesanan :
                </label>
                <input type="text" name="pesanan[${index}]" class="form-control" placeholder="Nama Pesanan" readonly>
            </div>
            <div class="col-xl-4">
                 <label class="form-label">
                    <span class="text-danger">*</span>
                    Harga :
                </label>
                <input type="number" step="0.01" name="harga[${index}]" class="form-control"  required>
            </div>
            <div class="col-xl-2">
                <button type="button" class="btn btn-sm btn-danger remove-detail-row" onclick="removeDetail(this)">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;

        container.appendChild(row);
    }

    function removeDetail(element) {
        const container = document.getElementById('detail-container');
        const row = element.closest('.cloned-row'); // Find the closest parent with the class 'row'
        if (row) {
             row.remove();
        }

    }
</script>
@endsection
