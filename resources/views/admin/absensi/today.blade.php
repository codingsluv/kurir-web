@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between mb-4">
        <div>
            <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
        <div>
            <form method="GET" action="{{ route('export.absensi.excel') }}" style="display: inline-block;">
                @if(isset($today))
                    <input type="hidden" name="tanggal" value="{{ $today }}">
                @elseif(isset($report_date))
                     <input type="hidden" name="tanggal" value="{{ $report_date }}">
                @elseif (isset($month) && isset($year))
                    <input type="hidden" name="bulan" value="{{ $month }}">
                    <input type="hidden" name="tahun" value="{{ $year }}">
                @endif
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-file-excel"></i>
                    Excel
                </button>
            </form>
            <form method="GET" action="{{ route('export.absensi.pdf') }}" style="display: inline-block; margin-left: 10px;">
                 @if(isset($today))
                    <input type="hidden" name="tanggal" value="{{ $today }}">
                 @elseif(isset($report_date))
                     <input type="hidden" name="tanggal" value="{{ $report_date }}">
                @elseif (isset($month) && isset($year))
                    <input type="hidden" name="bulan" value="{{ $month }}">
                    <input type="hidden" name="tahun" value="{{ $year }}">
                @endif
                <button type="submit" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i>
                    PDF
                </button>
            </form>
        </div>
    </div>

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
@endsection
