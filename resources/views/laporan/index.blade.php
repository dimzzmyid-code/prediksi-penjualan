@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="space-y-8">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-4xl font-bold text-slate-800">
                Laporan Penjualan
            </h1>
            <p class="text-slate-500 mt-2">
                Ringkasan data prediksi dan penjualan.
            </p>
        </div>

        <a href="{{ route('laporan.pdf') }}"
           target="_blank"
           class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow font-semibold">
            Export PDF
        </a>
    </div>

    {{-- Statistik --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Total Prediksi</p>
            <h2 class="text-4xl font-bold text-blue-600 mt-2">
                {{ $prediksis->count() }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Total Penjualan</p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ $totalPenjualan }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Prediksi Terakhir</p>
            <h2 class="text-4xl font-bold text-orange-600 mt-2">
                {{ $prediksiTerakhir }}
            </h2>
        </div>

    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl shadow border overflow-hidden">
        <div class="px-6 py-4 border-b bg-slate-50">
            <h2 class="text-xl font-bold text-slate-800">
                Data Prediksi Penjualan
            </h2>
        </div>

        @if($prediksis->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-100 text-slate-600 uppercase text-xs">
                        <tr>
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama Roti</th>
                            <th class="px-6 py-4 text-left">Periode</th>
                            <th class="px-6 py-4 text-left">Hasil Prediksi</th>
                            <th class="px-6 py-4 text-left">Nilai A</th>
                            <th class="px-6 py-4 text-left">Nilai B</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach($prediksis as $index => $item)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 font-semibold">
                                {{ $item->roti->nama_roti ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $item->periode_prediksi }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full font-semibold">
                                    {{ $item->hasil_prediksi }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($item->nilai_a, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                {{ number_format($item->nilai_b, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="p-10 text-center text-slate-500">
                Belum ada data prediksi.
            </div>
        @endif
    </div>

</div>
@endsection