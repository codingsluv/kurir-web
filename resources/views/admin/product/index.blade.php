@extends('layouts.app')
@section('content')
    <h1>Data Product</h1>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div>
                <a href="{{ route('createProduct') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Product
                </a>
            </div>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-info text-white">
                        <tr class="text-center">
                            <th>Nama Product</th>
                            <th>Deskripsi</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->nama_product }}</td>
                            <td>{{ $product->deskripsi }}</td>
                            <td>{{ $product->harga }}</td>
                            <td>{{ $product->kategori }}</td>
                            <!-- <td>
                                 @if (is_string($product->gambar) && json_decode($product->gambar) !== null)
                                    <ul>
                                        @foreach (json_decode($product->gambar) as $item)
                                            <li>{{ $item->nama ?? '' }} ({{ $item->jumlah ?? 1 }}) {{ $item->catatan ?? '' }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    {{ $product->gambar }}
                                @endif
                            </td> -->
                            
                            <td class="text-center">
                                <a href="{{ route('editProduct', $product->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modalDelete{{ $product->id }}">
                                    Hapus
                                </button>

                                <div class="modal fade" id="modalDelete{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="modalDeleteLabel{{ $product->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-danger text-white">
                                                <h5 class="modal-title">Hapus Data Product?</h5>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Nama Product: <strong>{{ $product->nama_product }}</strong></p>
                                                <p>Deskripsi: <strong>{{ $product->deskripsi }}</strong></p>
                                                <p>Harga: <strong>{{ $product->harga }}</strong></p>
                                                <p>Kategori: <strong>{{ $product->kategori }}</strong></p>
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{ route('deleteProduct', $product->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
