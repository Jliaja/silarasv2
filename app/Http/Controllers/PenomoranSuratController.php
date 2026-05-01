<?php

namespace App\Http\Controllers;

use App\Models\PenomoranSurat;
use App\Models\KategoriSurat;
use Illuminate\Http\Request;

class PenomoranSuratController extends Controller
{
    public function index()
    {
        $penomoran = PenomoranSurat::with('kategori')->get();
        return view('admin.penomoran.index', compact('penomoran'));
    }

    public function create()
    {
        $kategori = KategoriSurat::all();
        return view('admin.penomoran.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|unique:penomoran_surat',
            'nomor_terakhir' => 'required|integer|min:0',
            'format_nomor' => 'nullable|string',
        ]);

        PenomoranSurat::create($request->only(['id_kategori', 'nomor_terakhir', 'format_nomor']));

        return redirect()->route('admin.penomoran.index')->with('success', 'Penomoran berhasil ditambahkan');
    }

    public function edit($id)
    {
        $penomoran = PenomoranSurat::findOrFail($id);
        $kategori = KategoriSurat::all();
        return view('admin.penomoran.edit', compact('penomoran', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $penomoran = PenomoranSurat::findOrFail($id);

        $request->validate([
            'id_kategori' => 'required|unique:penomoran_surat,id_kategori,' . $id,
            'nomor_terakhir' => 'required|integer|min:0',
            'format_nomor' => 'nullable|string',
        ]);

        $penomoran->update($request->only(['id_kategori', 'nomor_terakhir', 'format_nomor']));

        return redirect()->route('admin.penomoran.index')->with('success', 'Penomoran berhasil diperbarui');
    }

    public function destroy($id)
    {
        $penomoran = PenomoranSurat::findOrFail($id);
        $penomoran->delete();

        return redirect()->route('admin.penomoran.index')->with('success', 'Penomoran berhasil dihapus');
    }
}