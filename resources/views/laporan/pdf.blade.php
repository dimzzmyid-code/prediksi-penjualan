<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Prediksi Penjualan</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        h2 {
            text-align: center;
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #000;
        }

        th {
            background: #f2f2f2;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <h2>Laporan Prediksi Penjualan Roti</h2>
    <p>Sistem Prediksi Penjualan Metode Linear Regression</p>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Roti</th>
                <th>Periode Prediksi</th>
                <th>Hasil Prediksi</th>
                <th>Nilai A</th>
                <th>Nilai B</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prediksis as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $item->roti->nama_roti ?? '-' }}</td>
                    <td>{{ $item->periode_prediksi }}</td>
                    <td class="text-center">{{ $item->hasil_prediksi }}</td>
                    <td>{{ number_format($item->nilai_a, 2) }}</td>
                    <td>{{ number_format($item->nilai_b, 2) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">
                        Belum ada data prediksi.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>