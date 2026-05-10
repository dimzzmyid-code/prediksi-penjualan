@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Data Roti</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('roti.update', $roti->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama Roti</label>
            <input type="text"
                   name="nama_roti"
                   class="form-control"
                   value="{{ old('nama_roti', $roti->nama_roti) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga</label>
            <input type="number"
                   name="harga"
                   class="form-control"
                   value="{{ old('harga', $roti->harga) }}"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">Stok</label>
            <input type="number"
                   name="stok"
                   class="form-control"
                   value="{{ old('stok', $roti->stok) }}"
                   required>
        </div>

        <button type="submit" class="btn btn-primary">
            Update
        </button>

        <a href="{{ route('roti.index') }}" class="btn btn-secondary">
            Kembali
        </a>
    </form>
</div>
@endsection