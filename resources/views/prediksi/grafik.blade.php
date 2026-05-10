@extends('layouts.app')

@php
    // Ambil nilai prediksi terakhir dengan aman
    $prediksiTerakhir = 0;

    if (!empty($prediksiData) && is_array($prediksiData)) {
        $filtered = array_filter($prediksiData, function ($value) {
            return $value !== null;
        });

        if (!empty($filtered)) {
            $prediksiTerakhir = array_values($filtered);
            $prediksiTerakhir = end($prediksiTerakhir) ?: 0;
        }
    }
@endphp

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div>
        <h1 class="text-3xl font-bold text-slate-800">
            Grafik Penjualan
        </h1>
        <p class="text-slate-500">
            Visualisasi histori penjualan dan hasil prediksi.
        </p>
    </div>

    <!-- Statistik Ringkas -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Data Penjualan</p>
            <h3 class="text-3xl font-bold text-slate-800">
                {{ count($labels ?? []) }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Prediksi Terakhir</p>
            <h3 class="text-3xl font-bold text-amber-700">
                {{ $prediksiTerakhir }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Metode</p>
            <h3 class="text-xl font-bold text-green-600">
                Linear Regression
            </h3>
        </div>

    </div>

    <!-- Chart -->
    <div class="bg-white rounded-3xl shadow p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6">
            Grafik Penjualan dan Prediksi
        </h2>

        @if(count($labels ?? []) > 0)
            <div class="relative h-[420px]">
                <canvas id="salesChart"></canvas>
            </div>
        @else
            <div class="text-center py-16">
                <p class="text-slate-500">
                    Belum ada data penjualan untuk ditampilkan.
                </p>
            </div>
        @endif
    </div>

</div>

@if(count($labels ?? []) > 0)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('salesChart');

    if (!canvas) return;

    const ctx = canvas.getContext('2d');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($labels ?? []),
            datasets: [
                {
                    label: 'Histori Penjualan',
                    data: @json($historicalData ?? []),
                    borderColor: '#92400e',
                    backgroundColor: 'rgba(146, 64, 14, 0.1)',
                    borderWidth: 4,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    fill: false
                },
                {
                    label: 'Hasil Prediksi',
                    data: @json($prediksiData ?? []),
                    borderColor: '#f59e0b',
                    backgroundColor: 'rgba(245, 158, 11, 0.1)',
                    borderWidth: 4,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    borderDash: [8, 8],
                    fill: false
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,

            interaction: {
                mode: 'index',
                intersect: false
            },

            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        usePointStyle: true,
                        padding: 20
                    }
                },

                tooltip: {
                    backgroundColor: '#0f172a',
                    padding: 12,
                    cornerRadius: 10
                }
            },

            scales: {
                x: {
                    grid: {
                        display: false
                    }
                },

                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endif
@endsection