<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Prediksi;
use App\Models\Roti;
use Illuminate\Http\Request;

class PrediksiController extends Controller
{
    /**
     * Menampilkan halaman form prediksi.
     */
    public function index()
    {
        $rotis = Roti::all();
        return view('prediksi.index', compact('rotis'));
    }

    /**
     * Memproses perhitungan regresi linear.
     */
    public function proses(Request $request)
    {
        $request->validate([
            'roti_id' => 'required|exists:rotis,id',
        ]);

        $roti = Roti::findOrFail($request->roti_id);

        $data = Penjualan::where('roti_id', $request->roti_id)
            ->orderBy('tanggal_penjualan')
            ->get();

        // Minimal 2 data penjualan
        if ($data->count() < 2) {
            return back()->with('error', 'Minimal harus ada 2 data penjualan.');
        }

        $n = $data->count();

        $sumX = 0;
        $sumY = 0;
        $sumXY = 0;
        $sumX2 = 0;

        $detail = [];

        foreach ($data as $index => $item) {
            $x = $index + 1;
            $y = $item->jumlah_terjual;

            $sumX += $x;
            $sumY += $y;
            $sumXY += $x * $y;
            $sumX2 += $x * $x;

            $detail[] = [
                'x' => $x,
                'tanggal' => $item->tanggal_penjualan,
                'y' => $y,
                'xy' => $x * $y,
                'x2' => $x * $x,
            ];
        }

        // Hitung koefisien b (slope)
        $b = (($n * $sumXY) - ($sumX * $sumY)) /
             (($n * $sumX2) - ($sumX * $sumX));

        // Hitung koefisien a (intercept)
        $a = ($sumY - ($b * $sumX)) / $n;

        // Prediksi periode berikutnya
        $xPrediksi = $n + 1;
        $hasilPrediksi = round($a + ($b * $xPrediksi));

        // Simpan hasil prediksi ke database
        $prediksi = Prediksi::create([
            'roti_id' => $roti->id,
            'periode_prediksi' => 'Periode ke-' . $xPrediksi,
            'hasil_prediksi' => $hasilPrediksi,
            'nilai_a' => $a,
            'nilai_b' => $b,
        ]);

        // Tampilkan halaman hasil prediksi
        return view('prediksi.hasil', [
            'roti'            => $roti,
            'detail'          => $detail,
            'n'               => $n,
            'sumX'            => $sumX,
            'sumY'            => $sumY,
            'sumXY'           => $sumXY,
            'sumX2'           => $sumX2,
            'a'               => $a,
            'b'               => $b,
            'xPrediksi'       => $xPrediksi,
            'hasilPrediksi'   => $hasilPrediksi,
            'prediksi'        => $prediksi,
        ]);
    }

    /**
     * Menampilkan grafik histori penjualan dan prediksi.
     */
    public function grafik()
    {
        // Ambil semua data penjualan berdasarkan tanggal
        $penjualans = Penjualan::orderBy('tanggal_penjualan', 'asc')->get();

        $labels = [];
        $historicalData = [];

        foreach ($penjualans as $penjualan) {
            $labels[] = date(
                'd M',
                strtotime($penjualan->tanggal_penjualan)
            );

            $historicalData[] = (int) $penjualan->jumlah_terjual;
        }

        // Isi array prediksi dengan null agar garis prediksi
        // hanya muncul di titik terakhir
        $prediksiData = array_fill(
            0,
            count($historicalData),
            null
        );

        // Ambil prediksi terakhir
        $prediksiTerakhir = Prediksi::latest()->first();

        if ($prediksiTerakhir) {
            $labels[] = 'Prediksi';
            $historicalData[] = null;
            $prediksiData[] = (int) round(
                $prediksiTerakhir->hasil_prediksi
            );
        }

        return view('prediksi.grafik', compact(
            'labels',
            'historicalData',
            'prediksiData'
        ));
    }
}