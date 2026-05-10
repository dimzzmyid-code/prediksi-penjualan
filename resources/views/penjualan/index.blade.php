@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Data Penjualan</h1>
            <p class="text-slate-500">
                Catat dan kelola histori penjualan untuk analisis prediksi.
            </p>
        </div>

        <div class="bg-amber-50 border border-amber-200 text-amber-800 px-4 py-3 rounded-xl max-w-md">
            Data ini akan digunakan untuk perhitungan
            <strong>Linear Regression</strong>.
        </div>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tombol Tambah -->
    <div>
        <a href="{{ route('penjualan.create') }}"
           class="inline-flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-3 rounded-xl shadow">
            <span>+</span>
            <span>Tambah Penjualan</span>
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold text-slate-800">
                Histori Penjualan
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">No</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Nama Roti</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Tanggal</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Jumlah</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Total Harga</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($penjualans as $index => $penjualan)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $penjualans->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $penjualan->roti->nama_roti }}
                            </td>

                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($penjualan->tanggal_penjualan)->format('d-m-Y') }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm font-medium">
                                    {{ $penjualan->jumlah_terjual }} pcs
                                </span>
                            </td>

                            <td class="px-6 py-4 font-semibold text-green-600">
                                Rp {{ number_format($penjualan->total_harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('penjualan.edit', $penjualan->id) }}"
                                       class="px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}"
                                          method="POST"
                                          class="inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                onclick="return confirm('Yakin ingin menghapus data ini?')"
                                                class="px-3 py-2 rounded-lg bg-red-100 text-red-700 hover:bg-red-200 text-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6"
                                class="px-6 py-8 text-center text-slate-500">
                                Belum ada data penjualan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t bg-slate-50">
            {{ $penjualans->links() }}
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Transaksi</p>
            <h3 class="text-3xl font-bold text-slate-800">
                {{ $penjualans->total() }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Omzet</p>
            <h3 class="text-2xl font-bold text-green-600">
                Rp {{ number_format(\App\Models\Penjualan::sum('total_harga'), 0, ',', '.') }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Unit Terjual</p>
            <h3 class="text-3xl font-bold text-amber-700">
                {{ \App\Models\Penjualan::sum('jumlah_terjual') }}
            </h3>
        </div>

    </div>

</div>
@endsection