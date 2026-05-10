<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use App\Models\Penjualan;
use App\Models\Prediksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalRoti = Roti::count();
        $totalTransaksi = Penjualan::count();
        $totalPendapatan = Penjualan::sum('total_harga');
        $prediksiTerakhir = Prediksi::with('roti')->latest()->first();

        $penjualanTerbaru = Penjualan::with('roti')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalRoti',
            'totalTransaksi',
            'totalPendapatan',
            'prediksiTerakhir',
            'penjualanTerbaru'
        ));
    }
}
