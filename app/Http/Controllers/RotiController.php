<?php

namespace App\Http\Controllers;

use App\Models\Roti;
use Illuminate\Http\Request;

class RotiController extends Controller
{
    /**
     * Menampilkan daftar data roti.
     */
    public function index()
    {
        $rotis = Roti::latest()->paginate(10);

        return view('roti.index', compact('rotis'));
    }

    /**
     * Menampilkan form tambah data.
     */
    public function create()
    {
        return view('roti.create');
    }

    /**
     * Menyimpan data baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_roti' => 'required|string|max:100',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        Roti::create($request->all());

        return redirect()
            ->route('roti.index')
            ->with('success', 'Data roti berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit.
     */
    public function edit(Roti $roti)
    {
        return view('roti.edit', compact('roti'));
    }

    /**
     * Menyimpan perubahan data.
     */
    public function update(Request $request, Roti $roti)
    {
        $request->validate([
            'nama_roti' => 'required|string|max:100',
            'harga'     => 'required|numeric|min:0',
            'stok'      => 'required|integer|min:0',
        ]);

        $roti->update($request->all());

        return redirect()
            ->route('roti.index')
            ->with('success', 'Data roti berhasil diperbarui.');
    }

    /**
     * Menghapus data.
     */
    public function destroy(Roti $roti)
    {
        $roti->delete();

        return redirect()
            ->route('roti.index')
            ->with('success', 'Data roti berhasil dihapus.');
    }
}