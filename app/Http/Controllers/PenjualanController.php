<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use App\Models\Roti;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    public function index()
    {
        $penjualans = Penjualan::with('roti')
            ->latest()
            ->paginate(10);

        return view('penjualan.index', compact('penjualans'));
    }

    public function create()
    {
        $rotis = Roti::all();

        return view('penjualan.create', compact('rotis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'roti_id' => 'required|exists:rotis,id',
            'tanggal_penjualan' => 'required|date',
            'jumlah_terjual' => 'required|integer|min:1',
        ]);

        $roti = Roti::findOrFail($request->roti_id);

        $total_harga = $request->jumlah_terjual * $roti->harga;

        Penjualan::create([
            'roti_id' => $request->roti_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'jumlah_terjual' => $request->jumlah_terjual,
            'total_harga' => $total_harga,
        ]);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil ditambahkan.');
    }

    public function edit(Penjualan $penjualan)
    {
        $rotis = Roti::all();

        return view('penjualan.edit', compact('penjualan', 'rotis'));
    }

    public function update(Request $request, Penjualan $penjualan)
    {
        $request->validate([
            'roti_id' => 'required|exists:rotis,id',
            'tanggal_penjualan' => 'required|date',
            'jumlah_terjual' => 'required|integer|min:1',
        ]);

        $roti = Roti::findOrFail($request->roti_id);

        $total_harga = $request->jumlah_terjual * $roti->harga;

        $penjualan->update([
            'roti_id' => $request->roti_id,
            'tanggal_penjualan' => $request->tanggal_penjualan,
            'jumlah_terjual' => $request->jumlah_terjual,
            'total_harga' => $total_harga,
        ]);

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil diperbarui.');
    }

    public function destroy(Penjualan $penjualan)
    {
        $penjualan->delete();

        return redirect()
            ->route('penjualan.index')
            ->with('success', 'Data penjualan berhasil dihapus.');
    }
}