<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        // Ambil semua data prediksi beserta relasi roti
        $prediksis = Prediksi::with('roti')
            ->latest()
            ->get();

        // Total jumlah penjualan
        $totalPenjualan = Penjualan::sum('jumlah_terjual');

        // Prediksi terakhir
        $prediksiTerakhir = Prediksi::latest()->first()?->hasil_prediksi ?? 0;

        return view('laporan.index', compact(
            'prediksis',
            'totalPenjualan',
            'prediksiTerakhir'
        ));
    }

    public function pdf()
    {
        $prediksis = Prediksi::with('roti')
            ->latest()
            ->get();

        $pdf = Pdf::loadView('laporan.pdf', compact('prediksis'));

        return $pdf->download('laporan-prediksi-penjualan.pdf');
    }
}