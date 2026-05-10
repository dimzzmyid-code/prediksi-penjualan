@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Dashboard
        </h1>
        <p class="text-slate-500">
            Selamat datang, {{ auth()->user()->name }} 👋
        </p>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500 text-sm">Total Produk</p>
            <h2 class="text-3xl font-bold text-slate-800">
                {{ $totalRoti }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500 text-sm">Total Transaksi</p>
            <h2 class="text-3xl font-bold text-slate-800">
                {{ $totalTransaksi }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500 text-sm">Total Pendapatan</p>
            <h2 class="text-2xl font-bold text-green-600">
                Rp {{ number_format($totalPendapatan, 0, ',', '.') }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-gray-500 text-sm">Prediksi Terakhir</p>
            <h2 class="text-2xl font-bold text-amber-600">
                {{ $prediksiTerakhir?->hasil_prediksi ?? 0 }} unit
            </h2>
        </div>
    </div>

    <!-- Penjualan Terbaru -->
    <div class="bg-white rounded-2xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">
            5 Penjualan Terbaru
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b">
                        <th class="text-left py-3">Tanggal</th>
                        <th class="text-left py-3">Roti</th>
                        <th class="text-left py-3">Jumlah</th>
                        <th class="text-left py-3">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penjualanTerbaru as $item)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3">{{ $item->tanggal_penjualan }}</td>
                            <td class="py-3">{{ $item->roti->nama_roti }}</td>
                            <td class="py-3">{{ $item->jumlah_terjual }}</td>
                            <td class="py-3 font-semibold text-green-600">
                                Rp {{ number_format($item->total_harga, 0, ',', '.') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-4 text-center text-gray-500">
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection