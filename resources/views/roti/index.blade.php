@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Data Roti</h1>
            <p class="text-slate-500">
                Kelola inventaris dan katalog produk roti.
            </p>
        </div>

        <a href="{{ route('roti.create') }}"
           class="inline-flex items-center gap-2 bg-amber-700 hover:bg-amber-800 text-white px-5 py-3 rounded-xl shadow">
            <span>+</span>
            <span>Tambah Data</span>
        </a>
    </div>

    <!-- Alert -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tabel -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold text-amber-700">
                Katalog Produk
            </h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">No</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Nama Roti</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Harga</th>
                        <th class="text-left px-6 py-4 text-sm font-semibold text-slate-500">Stok</th>
                        <th class="text-right px-6 py-4 text-sm font-semibold text-slate-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($rotis as $index => $roti)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                {{ $rotis->firstItem() + $index }}
                            </td>

                            <td class="px-6 py-4 font-semibold text-slate-800">
                                {{ $roti->nama_roti }}
                            </td>

                            <td class="px-6 py-4">
                                Rp {{ number_format($roti->harga, 0, ',', '.') }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-sm font-medium">
                                    {{ $roti->stok }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">

                                    <a href="{{ route('roti.edit', $roti->id) }}"
                                       class="px-3 py-2 rounded-lg bg-yellow-100 text-yellow-700 hover:bg-yellow-200 text-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('roti.destroy', $roti->id) }}"
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
                            <td colspan="5"
                                class="px-6 py-8 text-center text-slate-500">
                                Belum ada data roti.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="p-4 border-t bg-slate-50">
            {{ $rotis->links() }}
        </div>
    </div>

    <!-- Statistik -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Jenis Roti</p>
            <h3 class="text-3xl font-bold text-slate-800">
                {{ $rotis->total() }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Total Stok</p>
            <h3 class="text-3xl font-bold text-amber-700">
                {{ \App\Models\Roti::sum('stok') }}
            </h3>
        </div>

        <div class="bg-white rounded-2xl shadow p-6">
            <p class="text-sm text-slate-500">Rata-rata Harga</p>
            <h3 class="text-2xl font-bold text-green-600">
                Rp {{ number_format(\App\Models\Roti::avg('harga') ?? 0, 0, ',', '.') }}
            </h3>
        </div>

    </div>

</div>
@endsection