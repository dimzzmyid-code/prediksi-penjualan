<?php

namespace App\Http\Controllers;

use App\Models\Prediksi;
use App\Models\Penjualan;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index()
    {
        $prediksis = Prediksi::with('roti')
            ->latest()
            ->get();

        $totalPenjualan = Penjualan::sum('jumlah_terjual');
        $totalPrediksi = $prediksis->count();
        $prediksiTerakhir = Prediksi::latest()->first()?->hasil_prediksi ?? 0;

        // Statistik tambahan
        $rataRataPenjualan = round(Penjualan::avg('jumlah_terjual') ?? 0, 2);
        $penjualanTertinggi = Penjualan::max('jumlah_terjual') ?? 0;
        $penjualanTerendah = Penjualan::min('jumlah_terjual') ?? 0;

        // Susun data laporan detail
        $laporanDetail = $prediksis->map(function ($item) {
            $penjualans = Penjualan::where('roti_id', $item->roti_id)
                ->orderBy('tanggal_penjualan')
                ->get();

            $persamaan = 'Y = ' . number_format($item->nilai_a, 2)
                . ' + (' . number_format($item->nilai_b, 2) . ' × X)';

            $tren = $item->nilai_b > 0
                ? 'Meningkat'
                : ($item->nilai_b < 0 ? 'Menurun' : 'Stabil');

            return [
                'prediksi' => $item,
                'penjualans' => $penjualans,
                'persamaan' => $persamaan,
                'tren' => $tren,
                'total_penjualan_roti' => $penjualans->sum('jumlah_terjual'),
                'rata_rata_roti' => round($penjualans->avg('jumlah_terjual') ?? 0, 2),
                'tertinggi_roti' => $penjualans->max('jumlah_terjual') ?? 0,
                'terendah_roti' => $penjualans->min('jumlah_terjual') ?? 0,
            ];
        });

        return view('laporan.index', compact(
            'prediksis',
            'laporanDetail',
            'totalPenjualan',
            'totalPrediksi',
            'prediksiTerakhir',
            'rataRataPenjualan',
            'penjualanTertinggi',
            'penjualanTerendah'
        ));
    }

    public function pdf()
    {
        $prediksis = Prediksi::with('roti')
            ->latest()
            ->get();

        $totalPenjualan = Penjualan::sum('jumlah_terjual');
        $prediksiTerakhir = Prediksi::latest()->first()?->hasil_prediksi ?? 0;
        $rataRataPenjualan = round(Penjualan::avg('jumlah_terjual') ?? 0, 2);
        $penjualanTertinggi = Penjualan::max('jumlah_terjual') ?? 0;
        $penjualanTerendah = Penjualan::min('jumlah_terjual') ?? 0;

        $laporanDetail = $prediksis->map(function ($item) {
            $penjualans = Penjualan::where('roti_id', $item->roti_id)
                ->orderBy('tanggal_penjualan')
                ->get();

            $persamaan = 'Y = ' . number_format($item->nilai_a, 2)
                . ' + (' . number_format($item->nilai_b, 2) . ' × X)';

            $tren = $item->nilai_b > 0
                ? 'Meningkat'
                : ($item->nilai_b < 0 ? 'Menurun' : 'Stabil');

            return [
                'prediksi' => $item,
                'penjualans' => $penjualans,
                'persamaan' => $persamaan,
                'tren' => $tren,
            ];
        });

        $pdf = Pdf::loadView('laporan.pdf', compact(
            'prediksis',
            'laporanDetail',
            'totalPenjualan',
            'prediksiTerakhir',
            'rataRataPenjualan',
            'penjualanTertinggi',
            'penjualanTerendah'
        ))->setPaper('A4', 'portrait');

        return $pdf->download('laporan-prediksi-penjualan.pdf');
    }

    /**
     * Hapus seluruh riwayat prediksi pada halaman laporan.
     */
    public function clear()
    {
        Prediksi::truncate();

        return redirect()
            ->route('laporan.index')
            ->with('success', 'Riwayat laporan berhasil dihapus.');
    }
}