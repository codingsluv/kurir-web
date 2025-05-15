@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mb-4">
            <i class="fas fa-wallet"></i>
            {{ $title }}
        </h1>

        <div class="card shadow-lg">
            <div class="card-body">
                <div class="alert alert-success">
                    Total Ongkir Anda: <b>Rp {{ number_format($total_ongkir_driver, 0, ',', '.') }}</b>
                </div>
                <div class="alert alert-info">
                    Gaji Anda (70% dari Ongkir): <b>Rp {{ number_format($gaji_driver, 0, ',', '.') }}</b>
                </div>
            </div>
        </div>
    </div>
@endsection