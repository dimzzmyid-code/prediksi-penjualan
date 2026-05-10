@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Hero Section -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow p-8 border border-slate-100">
            <span class="inline-block bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-semibold mb-4">
                Sistem Analitik DapoerPhy
            </span>

            <h2 class="text-3xl font-bold text-amber-700 mb-3">
                Optimasi Produksi Berbasis Data
            </h2>

            <p class="text-slate-600 leading-relaxed mb-6">
                Hasil prediksi menggunakan metode <strong>Linear Regression</strong>
                berdasarkan histori penjualan produk
                <strong>{{ $roti->nama_roti }}</strong>.
            </p>

            <div class="flex flex-wrap gap-3">
                <a href="{{ route('prediksi.index') }}"
                   class="bg-amber-700 hover:bg-amber-800 text-white px-6 py-3 rounded-xl shadow">
                    Prediksi Lagi
                </a>

                <a href="{{ route('grafik.index') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-xl">
                    Lihat Riwayat
                </a>
            </div>
        </div>

        <div class="bg-gradient-to-br from-amber-100 to-orange-200 rounded-3xl p-8 flex flex-col justify-end shadow">
            <h3 class="text-xl font-bold text-amber-900 mb-2">
                Akurasi Prediksi
            </h3>
            <p class="text-amber-800">
                Perbarui data penjualan secara rutin untuk hasil yang semakin akurat.
            </p>
        </div>
    </section>

    <!-- Hasil Prediksi -->
    <section class="grid grid-cols-1 lg:grid-cols-12 gap-6">

        <!-- Hasil Utama -->
        <div class="lg:col-span-8 bg-white rounded-3xl shadow p-8">
            <h3 class="text-2xl font-bold text-slate-800 mb-6">
                Hasil Prediksi Penjualan
            </h3>

            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-500">
                                Periode Prediksi
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-500">
                                Metode
                            </th>
                            <th class="px-6 py-4 text-right text-sm font-semibold text-slate-500">
                                Hasil
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-t">
                            <td class="px-6 py-6 font-semibold">
                                {{ $prediksi->periode_prediksi }}
                            </td>
                            <td class="px-6 py-6 text-slate-600">
                                Linear Regression
                            </td>
                            <td class="px-6 py-6 text-right">
                                <span class="text-3xl font-bold text-amber-700">
                                    {{ $hasilPrediksi }} unit
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="mt-8 p-5 bg-amber-50 border-l-4 border-amber-600 rounded-xl">
                <p class="text-slate-700 leading-relaxed">
                    <strong>Interpretasi:</strong>
                    Berdasarkan tren penjualan sebelumnya,
                    sistem memprediksi bahwa penjualan
                    <strong>{{ $roti->nama_roti }}</strong>
                    pada <strong>{{ $prediksi->periode_prediksi }}</strong>
                    akan mencapai sekitar
                    <strong>{{ $hasilPrediksi }} unit</strong>.
                </p>
            </div>
        </div>

        <!-- Detail Teknis -->
        <div class="lg:col-span-4 space-y-6">

            <div class="bg-white rounded-3xl shadow p-6">
                <h4 class="text-xl font-bold text-slate-800 mb-4">
                    Detail Teknis
                </h4>

                <div class="space-y-4">
                    <div class="p-4 bg-slate-50 rounded-xl">
                        <p class="text-sm text-slate-500 uppercase mb-1">
                            Nilai A (Intercept)
                        </p>
                        <p class="text-3xl font-bold text-amber-700">
                            {{ round($a, 4) }}
                        </p>
                    </div>

                    <div class="p-4 bg-slate-50 rounded-xl">
                        <p class="text-sm text-slate-500 uppercase mb-1">
                            Nilai B (Slope)
                        </p>
                        <p class="text-3xl font-bold text-green-600">
                            {{ round($b, 4) }}
                        </p>
                    </div>

                    <div class="p-4 bg-slate-900 rounded-xl text-white">
                        <p class="text-sm text-slate-300 mb-2">
                            Persamaan Regresi
                        </p>
                        <code class="text-sm break-words">
                            Y = {{ round($a, 4) }} + ({{ round($b, 4) }} × X)
                        </code>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl shadow p-6">
                <p class="text-sm text-slate-500 mb-1">Jumlah Data</p>
                <p class="text-2xl font-bold text-slate-800">{{ $n }}</p>

                <hr class="my-4">

                <p class="text-sm text-slate-500 mb-1">Periode Prediksi</p>
                <p class="text-xl font-semibold text-amber-700">
                    X = {{ $xPrediksi }}
                </p>
            </div>
        </div>

    </section>

    <!-- Tabel Perhitungan -->
    <section class="bg-white rounded-3xl shadow p-8">
        <h3 class="text-2xl font-bold text-slate-800 mb-6">
            Detail Perhitungan Regresi
        </h3>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-4 py-3 text-left">X</th>
                        <th class="px-4 py-3 text-left">Tanggal</th>
                        <th class="px-4 py-3 text-left">Y</th>
                        <th class="px-4 py-3 text-left">XY</th>
                        <th class="px-4 py-3 text-left">X²</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($detail as $row)
                        <tr>
                            <td class="px-4 py-3">{{ $row['x'] }}</td>
                            <td class="px-4 py-3">{{ $row['tanggal'] }}</td>
                            <td class="px-4 py-3">{{ $row['y'] }}</td>
                            <td class="px-4 py-3">{{ $row['xy'] }}</td>
                            <td class="px-4 py-3">{{ $row['x2'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-slate-50 font-semibold">
                    <tr>
                        <td class="px-4 py-3">ΣX = {{ $sumX }}</td>
                        <td class="px-4 py-3"></td>
                        <td class="px-4 py-3">ΣY = {{ $sumY }}</td>
                        <td class="px-4 py-3">ΣXY = {{ $sumXY }}</td>
                        <td class="px-4 py-3">ΣX² = {{ $sumX2 }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </section>

</div>
@endsection