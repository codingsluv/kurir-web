<?php
namespace App\Exports;

use App\Models\Gaji;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class GajiExport implements FromView
{
    public function view(): View
    {
        // Ambil data gaji dari database atau sumber lainnya
        $dataGaji = Gaji::with('user')->get();

        // Mengirim data ke view untuk ditampilkan di Excel
        return view('exports.gaji', [
            'dataGaji' => $dataGaji
        ]);
    }
}