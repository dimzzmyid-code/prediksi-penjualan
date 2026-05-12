<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Prediksi Penjualan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #1f2937;
        }

        h1 {
            text-align: center;
            margin-bottom: 5px;
        }

        .subtitle {
            text-align: center;
            color: #6b7280;
            margin-bottom: 25px;
        }

        .box {
            border: 1px solid #d1d5db;
            padding: 10px;
            margin-bottom: 15px;
            background: #f9fafb;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #d1d5db;
            padding: 8px;
            text-align: left;
        }

        th {
            background: #f3f4f6;
        }

        .section-title {
            margin-top: 20px;
            font-size: 14px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<h1>Laporan Prediksi Penjualan Roti</h1>
<p class="subtitle">Sistem Prediksi Penjualan Menggunakan Metode Regresi Linear</p>

<div class="box">
    <strong>Total Penjualan:</strong> {{ number_format($totalPenjualan) }} pcs<br>
    <strong>Prediksi Terakhir:</strong> {{ number_format($prediksiTerakhir) }} pcs<br>
    <strong>Rata-rata Penjualan:</strong> {{ $rataRataPenjualan }} pcs<br>
    <strong>Penjualan Tertinggi:</strong> {{ $penjualanTertinggi }} pcs<br>
    <strong>Penjualan Terendah:</strong> {{ $penjualanTerendah }} pcs
</div>

@foreach($laporanDetail as $item)
    <div class="section-title">
        {{ $item['prediksi']->roti->nama_roti ?? '-' }}
    </div>

    <div class="box">
        <strong>Persamaan:</strong> {{ $item['persamaan'] }}<br>
        <strong>Nilai A:</strong> {{ number_format($item['prediksi']->nilai_a, 2) }}<br>
        <strong>Nilai B:</strong> {{ number_format($item['prediksi']->nilai_b, 2) }}<br>
        <strong>Hasil Prediksi:</strong> {{ number_format($item['prediksi']->hasil_prediksi) }} pcs<br>
        <strong>Tren:</strong> {{ $item['tren'] }}
    </div>

    <p>
        Berdasarkan analisis regresi linear, penjualan
        {{ $item['prediksi']->roti->nama_roti }} diprediksi sebesar
        {{ number_format($item['prediksi']->hasil_prediksi) }} pcs
        pada periode berikutnya dengan tren {{ strtolower($item['tren']) }}.
    </p>
@endforeach

</body>
</html>
