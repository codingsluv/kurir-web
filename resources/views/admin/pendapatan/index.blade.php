@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-2 text-gray-800">{{ $title }}</h1>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="alert alert-info">
                    Total Pendapatan dari Ongkir: <b>Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection