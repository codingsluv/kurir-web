<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;

class OrderExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    protected $orders;

    public function __construct(Collection $orders)
    {
        $this->orders = $orders;
    }

    public function collection()
    {
        return $this->orders->map(function ($order) {
            return [
                'ID Order' => $order->id,
                'Nama Pemesan' => $order->nama_pemesan,
                'No HP Pemesan' => $order->no_hp_pemesan,
                'Alamat Pengantaran' => $order->alamat_pengantaran,
                'Status' => $order->status,
                'Tanggal Dibuat' => $order->created_at,
            ];
        });
    }

    public function headings(): array
    {
         return [
            'ID Order',
            'Nama Pemesan',
            'No HP Pemesan',
            'Alamat Pengantaran',
            'Status',
            'Tanggal Dibuat',
        ];
    }
}