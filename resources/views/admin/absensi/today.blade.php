@extends('layouts.app')

@section('content')
    <h1>Absensi Hari Ini</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nama Driver</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $attendance)
                <tr>
                    <td>{{ $attendance->driver->nama }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>{{ $attendance->tanggal }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Tidak ada data absensi hari ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Kembali</a>
@endsection
