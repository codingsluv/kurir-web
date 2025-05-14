@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.absensi.mark') }}" method="POST">
                @csrf
                <input type="hidden" name="tanggal" value="{{ $today }}">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Driver</th>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Tidak Hadir</th>
                            <th class="text-center">Izin</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($drivers as $driver)
                            <tr>
                                <td>{{ $driver->nama }}</td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="status[{{ $driver->id }}]"
                                            value="hadir"
                                            {{ $attendances->get($driver->id)?->status === 'hadir' ? 'checked' : '' }}
                                        >
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="status[{{ $driver->id }}]"
                                            value="tidak_hadir"
                                            {{ $attendances->get($driver->id)?->status === 'tidak_hadir' ? 'checked' : '' }}
                                            {{ (!$attendances->has($driver->id) && old("status.".$driver->id) === 'tidak_hadir') ? 'checked' : (!$attendances->has($driver->id) && !old("status.".$driver->id) ? 'checked' : '') }}
                                        >
                                    </div>
                                </td>
                                 <td class="text-center">
                                    <div class="form-check">
                                        <input
                                            class="form-check-input"
                                            type="radio"
                                            name="status[{{ $driver->id }}]"
                                            value="izin"
                                            {{ $attendances->get($driver->id)?->status === 'izin' ? 'checked' : '' }}
                                            {{ (!$attendances->has($driver->id) && old("status.".$driver->id) === 'izin' ? 'checked' : '') }}
                                        >
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i>
                    Simpan Absensi Hari Ini
                </button>
            </form>

            <hr>

            <div>
                <a href="{{ route('admin.absensi.today') }}" class="btn btn-info">
                    <i class="fas fa-eye"></i>
                    Lihat Absensi Hari Ini
                </a>
                <a href="{{ route('admin.absensi.harian') }}" class="btn btn-info mr-2 bg-warning">
                    <i class="fas fa-calendar-week"></i>
                    Rekap Harian
                </a>
                <a href="{{ route('admin.absensi.bulanan') }}" class="btn btn-info bg-danger">
                    <i class="fas fa-calendar-check"></i>
                    Rekap Bulanan
                </a>
            </div>
        </div>
    </div>
@endsection
