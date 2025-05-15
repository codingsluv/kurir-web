<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;

class AbsensiExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $attendances;

    public function __construct(Collection $attendances)
    {
        $this->attendances = $attendances;
    }

    public function collection()
    {
        return $this->attendances->map(function ($attendance) {
            return [
                'Nama Driver' => $attendance->driver->nama,
                'Tanggal' => $attendance->tanggal,
                'Status' => $attendance->status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Driver',
            'Tanggal',
            'Status',
        ];
    }
}
