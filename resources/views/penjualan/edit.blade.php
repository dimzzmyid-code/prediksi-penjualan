@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-2xl font-bold mb-4">Edit Data Penjualan</h1>

    @if ($errors->any())
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Nama Roti</label>
            <select name="roti_id" class="border rounded w-full p-2" required>
                <option value="">-- Pilih Roti --</option>
                @foreach($rotis as $roti)
                    <option value="{{ $roti->id }}"
                        {{ old('roti_id', $penjualan->roti_id) == $roti->id ? 'selected' : '' }}>
                        {{ $roti->nama_roti }} - Rp {{ number_format($roti->harga, 0, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Tanggal Penjualan</label>
            <input type="date"
                   name="tanggal_penjualan"
                   value="{{ old('tanggal_penjualan', $penjualan->tanggal_penjualan) }}"
                   class="border rounded w-full p-2"
                   required>
        </div>

        <div class="mb-3">
            <label class="block mb-1 font-semibold">Jumlah Terjual</label>
            <input type="number"
                   name="jumlah_terjual"
                   value="{{ old('jumlah_terjual', $penjualan->jumlah_terjual) }}"
                   class="border rounded w-full p-2"
                   min="1"
                   required>
        </div>

        <button type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>

        <a href="{{ route('penjualan.index') }}"
           class="bg-gray-500 text-white px-4 py-2 rounded">
            Kembali
        </a>
    </form>
</div>
@endsection