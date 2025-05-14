@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.absensi.harian') }}" method="GET" class="mb-3">
                <div class="form-group">
                    <label for="date">Pilih Tanggal:</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $report_date }}">
                </div>
                <button type="submit" class="btn btn-primary">Tampilkan Rekap</button>
            </form>

            @if ($attendances->isNotEmpty())
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Driver</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($attendances as $attendance)
                            <tr>
                                <td>{{ $attendance->driver->nama }}</td> {{-- Sesuaikan nama relasi --}}
                                <td>
                                    @if ($attendance->status === 'hadir')
                                        <span class="badge badge-success">Hadir</span>
                                    @elseif ($attendance->status === 'tidak_hadir')
                                        <span class="badge badge-danger">Tidak Hadir</span>
                                    @else
                                        <span class="badge badge-warning">Izin</span>
                                    @endif
                                </td>
                                <td>{{ $attendance->tanggal }}</td> {{-- Sesuaikan nama kolom --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada data absensi untuk tanggal {{ $report_date }}.</p>
            @endif

            <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Kembali ke Absensi</a>
        </div>
    </div>
@endsection