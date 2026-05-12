@extends('layouts.app')

@section('title', 'Tambah Data Roti')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="roti-card">

        {{-- Ornamen Background --}}
        <div class="roti-card-pattern"></div>

        {{-- Judul --}}
        <h1 class="roti-title">Tambah Data Roti Baru</h1>
        <p class="roti-subtitle">
            Lengkapi informasi detail produk roti artisan untuk ditambahkan ke dalam
            sistem inventori.
        </p>

        {{-- Form --}}
        <form action="{{ route('roti.store') }}" method="POST">
            @csrf

            {{-- Nama Roti --}}
            <div class="mb-4">
                <label class="roti-label">Nama Roti</label>
                <input
                    type="text"
                    name="nama_roti"
                    value="{{ old('nama_roti') }}"
                    class="roti-input @error('nama_roti') is-invalid @enderror"
                    placeholder="Contoh: Sourdough Artisan"
                    required>

                @error('nama_roti')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            {{-- Harga + Stok --}}
            <div class="row g-4">

                {{-- Harga --}}
                <div class="col-md-6">
                    <label class="roti-label">Harga (Rp)</label>

                    <div class="roti-input-group">
                        <span class="roti-prefix">Rp</span>
                        <input
                            type="number"
                            name="harga"
                            value="{{ old('harga') }}"
                            class="roti-input-group-field @error('harga') is-invalid @enderror"
                            placeholder="0"
                            min="0"
                            required>
                    </div>

                    @error('harga')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Stok --}}
                <div class="col-md-6">
                    <label class="roti-label">Stok Awal</label>

                    <div class="roti-input-group">
                        <input
                            type="number"
                            name="stok"
                            value="{{ old('stok') }}"
                            class="roti-input-group-field @error('stok') is-invalid @enderror"
                            placeholder="0"
                            min="0"
                            required>
                        <span class="roti-suffix">Pcs</span>
                    </div>

                    @error('stok')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Tombol --}}
            <div class="d-flex flex-wrap gap-3 mt-5">
                <button type="submit" class="btn-simpan">
                    Simpan Data Roti
                </button>

                <a href="{{ route('roti.index') }}" class="btn-batal">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Card utama */
    .roti-card {
        position: relative;
        background: #ffffff;
        border-radius: 28px;
        padding: 36px;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        border: 1px solid #eef2f7;
        overflow: hidden;
        max-width: 1000px;
    }

    /* Ornamen sudut kanan atas */
    .roti-card-pattern {
        position: absolute;
        top: -20px;
        right: -20px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(148, 163, 184, 0.10), transparent 70%);
        pointer-events: none;
    }

    /* Judul */
    .roti-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 12px;
        line-height: 1.2;
    }

    /* Subjudul */
    .roti-subtitle {
        font-size: 1.05rem;
        color: #475569;
        max-width: 650px;
        line-height: 1.8;
        margin-bottom: 36px;
    }

    /* Label */
    .roti-label {
        display: block;
        font-size: 1rem;
        font-weight: 600;
        color: #0f172a;
        margin-bottom: 10px;
    }

    /* Input biasa */
    .roti-input {
        width: 100%;
        height: 56px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        padding: 0 18px;
        font-size: 1rem;
        color: #0f172a;
        background: #ffffff;
        transition: all 0.25s ease;
    }

    .roti-input::placeholder,
    .roti-input-group-field::placeholder {
        color: #94a3b8;
    }

    .roti-input:focus,
    .roti-input-group-field:focus {
        outline: none;
        border-color: #c46a00;
        box-shadow: 0 0 0 4px rgba(196, 106, 0, 0.10);
    }

    /* Input group */
    .roti-input-group {
        display: flex;
        align-items: center;
        height: 56px;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        overflow: hidden;
        background: #ffffff;
        transition: all 0.25s ease;
    }

    .roti-input-group:focus-within {
        border-color: #c46a00;
        box-shadow: 0 0 0 4px rgba(196, 106, 0, 0.10);
    }

    .roti-prefix,
    .roti-suffix {
        padding: 0 14px;
        font-weight: 600;
        color: #7c2d12;
        background: transparent;
        white-space: nowrap;
    }

    .roti-suffix {
        color: #94a3b8;
        font-weight: 500;
    }

    .roti-input-group-field {
        flex: 1;
        border: none;
        outline: none;
        height: 100%;
        padding: 0 8px;
        font-size: 1rem;
        background: transparent;
        color: #0f172a;
    }

    /* Tombol Simpan */
    .btn-simpan {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 220px;
        height: 52px;
        padding: 0 32px;
        border: none;
        border-radius: 14px;
        background: linear-gradient(135deg, #a85d00, #c46a00);
        color: #ffffff;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        box-shadow: 0 8px 18px rgba(168, 93, 0, 0.25);
        transition: all 0.25s ease;
    }

    .btn-simpan:hover {
        transform: translateY(-1px);
        box-shadow: 0 12px 24px rgba(168, 93, 0, 0.30);
        color: #ffffff;
    }

    /* Tombol Batal */
    .btn-batal {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 120px;
        height: 52px;
        padding: 0 28px;
        border-radius: 14px;
        background: #eef2ff;
        color: #c46a00;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.25s ease;
    }

    .btn-batal:hover {
        background: #e0e7ff;
        color: #a85d00;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .roti-card {
            padding: 24px;
            border-radius: 20px;
        }

        .roti-title {
            font-size: 1.75rem;
        }

        .roti-subtitle {
            font-size: 0.95rem;
            margin-bottom: 28px;
        }

        .btn-simpan,
        .btn-batal {
            width: 100%;
        }
    }
</style>
@endpush
