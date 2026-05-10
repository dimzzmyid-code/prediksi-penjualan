@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Hero -->
    <section class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow p-8 border border-slate-100">
            <span class="inline-block bg-amber-100 text-amber-800 px-3 py-1 rounded-full text-sm font-semibold mb-4">
                Sistem Analysis DapoerPhy
            </span>

            <h1 class="text-3xl font-bold text-amber-700 mb-3">
                Prediksi Penjualan Linear Regression
            </h1>

            <p class="text-slate-600 leading-relaxed">
                Pilih produk roti yang ingin dianalisis.
                Sistem akan menghitung prediksi penjualan berdasarkan
                histori data penjualan sebelumnya.
            </p>
        </div>

        <div class="bg-gradient-to-br from-amber-100 to-orange-200 rounded-3xl p-8 shadow flex flex-col justify-end">
            <h3 class="text-xl font-bold text-amber-900 mb-2">
                Akurasi Prediksi
            </h3>
            <p class="text-amber-800">
                Semakin banyak data penjualan, semakin akurat hasil prediksi.
            </p>
        </div>
    </section>

    <!-- Alert Error -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
            {{ $errors->first() }}
        </div>
    @endif

    <!-- Form Prediksi -->
    <div class="bg-white rounded-3xl shadow p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Form Prediksi Penjualan
        </h2>

        <form action="{{ route('prediksi.proses') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Pilih Roti
                </label>

                <select name="roti_id"
                        required
                        class="w-full rounded-xl border-slate-300 focus:border-amber-500 focus:ring-amber-500">
                    <option value="">-- Pilih Roti --</option>
                    @foreach($rotis as $roti)
                        <option value="{{ $roti->id }}">
                            {{ $roti->nama_roti }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="bg-amber-700 hover:bg-amber-800 text-white px-6 py-3 rounded-xl shadow">
                    Hitung Prediksi
                </button>

                <a href="{{ route('grafik.index') }}"
                   class="bg-slate-100 hover:bg-slate-200 text-slate-700 px-6 py-3 rounded-xl">
                    Lihat Riwayat
                </a>
            </div>
        </form>
    </div>

    <!-- Informasi Metode -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500 mb-2">Metode</p>
            <h3 class="text-xl font-bold text-slate-800">
                Linear Regression
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500 mb-2">Jumlah Produk</p>
            <h3 class="text-3xl font-bold text-amber-700">
                {{ $rotis->count() }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500 mb-2">Data Historis</p>
            <h3 class="text-3xl font-bold text-green-600">
                {{ \App\Models\Penjualan::count() }}
            </h3>
        </div>

    </div>

</div>
@endsection