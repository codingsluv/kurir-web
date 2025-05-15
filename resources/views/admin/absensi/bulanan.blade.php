@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card">
        <div class="card-header d-flex flex-wrap justify-content-center justify-content-xl-between">
            <div class="mb-1 mr-2">
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
        <div class="card-body">
            <form action="{{ route('admin.absensi.bulanan') }}" method="GET" class="mb-3">
                <div class="form-group">
                    <label for="month">Pilih Bulan:</label>
                    <select class="form-control" id="month" name="month">
                        @for ($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $month == $i ? 'selected' : '' }}>{{ \Carbon\Carbon::create(null, $i, 1)->format('F') }}</option>
                        @endfor
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Pilih Tahun:</label>
                    <select class="form-control" id="year" name="year">
                        @for ($i = \Carbon\Carbon::now()->year - 5; $i <= \Carbon\Carbon::now()->year + 5; $i++)
                            <option value="{{ $i }}" {{ $year == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Tampilkan Rekap</button>
            </form>

            @if ($attendances->isNotEmpty())
                <table class="table table-bordered ">
                    <thead>
                        <tr>
                            <th>Nama Driver</th>
                            @for ($i = 1; $i <= \Carbon\Carbon::create($year, $month, 1)->daysInMonth; $i++)
                                <th class="text-center">{{ $i }}</th>
                            @endfor
                            <th class="text-center">Total Hadir</th>
                            <th class="text-center">Total Tidak Hadir</th>
                            <th class="text-center">Total Izin</th> {{-- Tambahkan total izin --}}
                        </tr>
                    </thead>
                    <tbody class="table">
                        @foreach ($attendances as $driverId => $driverAttendances)
                            <tr>
                                <td>{{ $driverAttendances->first()->driver->nama }}</td> {{-- Sesuaikan nama relasi --}}
                                @php
                                    $totalHadir = 0;
                                    $totalTidakHadir = 0;
                                    $totalIzin = 0;
                                @endphp
                                @for ($i = 1; $i <= \Carbon\Carbon::create($year, $month, 1)->daysInMonth; $i++)
                                    @php
                                        $attendance = $driverAttendances->firstWhere('tanggal', \Carbon\Carbon::create($year, $month, $i)->toDateString());
                                    @endphp
                                    <td class="text-center">
                                        @if ($attendance)
                                            @if ($attendance->status === 'hadir')
                                                <span class="badge badge-success">H</span>
                                                @php $totalHadir++; @endphp
                                            @elseif ($attendance->status === 'tidak_hadir')
                                                <span class="badge badge-danger">TH</span>
                                                @php $totalTidakHadir++; @endphp
                                            @else
                                                <span class="badge badge-warning">I</span>
                                                @php $totalIzin++; @endphp
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                @endfor
                                <td class="text-center">{{ $totalHadir }}</td>
                                <td class="text-center">{{ $totalTidakHadir }}</td>
                                <td class="text-center">{{ $totalIzin }}</td> {{-- Tampilkan total izin --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada data absensi untuk bulan {{ \Carbon\Carbon::create($year, $month, 1)->format('F Y') }}.</p>
            @endif

            <a href="{{ route('admin.absensi.index') }}" class="btn btn-secondary">Kembali ke Absensi</a>
        </div>
    </div>
@endsection