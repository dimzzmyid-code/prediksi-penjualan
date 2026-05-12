@extends('layouts.app')

@section('title', 'Laporan Penjualan')

@section('content')
<div class="space-y-8">

    {{-- Alert Success --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl shadow-sm">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-green-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-medium">
                    {{ session('success') }}
                </span>
            </div>
        </div>
    @endif

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4">
        <div>
            <h1 class="text-4xl font-bold text-slate-800">
                Laporan Prediksi Penjualan
            </h1>
            <p class="text-slate-500 mt-2">
                Analisis lengkap hasil regresi linear dan prediksi penjualan roti.
            </p>
        </div>

        <div class="flex items-center gap-3">
            {{-- Tombol Clear History --}}
            <form action="{{ route('laporan.clear') }}"
                  method="POST"
                  onsubmit="return confirm('Yakin ingin menghapus seluruh riwayat laporan?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow font-semibold transition">
                    Clear History
                </button>
            </form>

            {{-- Tombol Export PDF --}}
            <a href="{{ route('laporan.pdf') }}"
               target="_blank"
               class="px-5 py-3 bg-red-600 hover:bg-red-700 text-white rounded-xl shadow font-semibold transition">
                Export PDF
            </a>
        </div>
    </div>

    {{-- Statistik Utama --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Total Prediksi</p>
            <h2 class="text-4xl font-bold text-blue-600 mt-2">
                {{ $totalPrediksi }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Total Penjualan</p>
            <h2 class="text-4xl font-bold text-green-600 mt-2">
                {{ number_format($totalPenjualan) }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Prediksi Terakhir</p>
            <h2 class="text-4xl font-bold text-orange-600 mt-2">
                {{ number_format($prediksiTerakhir) }}
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-6">
            <p class="text-sm text-slate-500">Rata-rata</p>
            <h2 class="text-4xl font-bold text-purple-600 mt-2">
                {{ $rataRataPenjualan }}
            </h2>
        </div>
    </div>

    {{-- Detail per Prediksi --}}
    @forelse($laporanDetail as $item)
        <div class="bg-white rounded-3xl shadow border overflow-hidden">

            <div class="px-6 py-5 border-b bg-slate-50">
                <h2 class="text-2xl font-bold text-slate-800">
                    {{ $item['prediksi']->roti->nama_roti ?? '-' }}
                </h2>
                <p class="text-slate-500 mt-1">
                    {{ $item['persamaan'] }}
                </p>
            </div>

            <div class="p-6 grid md:grid-cols-4 gap-4">
                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-sm text-slate-500">Hasil Prediksi</p>
                    <h3 class="text-2xl font-bold text-amber-600">
                        {{ number_format($item['prediksi']->hasil_prediksi) }} pcs
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-sm text-slate-500">Nilai A</p>
                    <h3 class="text-xl font-bold">
                        {{ number_format($item['prediksi']->nilai_a, 2) }}
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-sm text-slate-500">Nilai B</p>
                    <h3 class="text-xl font-bold">
                        {{ number_format($item['prediksi']->nilai_b, 2) }}
                    </h3>
                </div>

                <div class="bg-slate-50 rounded-xl p-4">
                    <p class="text-sm text-slate-500">Tren</p>
                    <h3 class="text-xl font-bold">
                        {{ $item['tren'] }}
                    </h3>
                </div>
            </div>

            <div class="px-6 pb-6">
                <h3 class="text-lg font-bold text-slate-800 mb-3">
                    Kesimpulan
                </h3>
                <p class="text-slate-600 leading-8">
                    Berdasarkan hasil analisis regresi linear, penjualan
                    <strong>{{ $item['prediksi']->roti->nama_roti }}</strong>
                    diprediksi sebesar
                    <strong>{{ number_format($item['prediksi']->hasil_prediksi) }} pcs</strong>
                    pada periode berikutnya dengan tren
                    <strong>{{ strtolower($item['tren']) }}</strong>.
                </p>
            </div>
        </div>
    @empty
        <div class="bg-white rounded-2xl shadow border p-10 text-center text-slate-500">
            Belum ada data prediksi.
        </div>
    @endforelse

</div>
@endsection