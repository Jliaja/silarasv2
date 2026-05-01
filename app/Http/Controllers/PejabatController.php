<?php

namespace App\Http\Controllers;

use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PejabatController extends Controller
{
    public function index()
    {
        $pejabat = Pejabat::all();
        return view('admin.pejabat.index', compact('pejabat'));
    }

    public function create()
    {
        return view('admin.pejabat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
        ];

        if ($request->hasFile('tanda_tangan')) {
            $path = $request->file('tanda_tangan')->store('ttd', 'public');
            $data['tanda_tangan'] = $path;
        }

        Pejabat::create($data);
        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        return view('admin.pejabat.edit', compact('pejabat'));
    }

    public function update(Request $request, $id)
    {
        $pejabat = Pejabat::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'nip' => 'nullable|string|max:50',
            'tanda_tangan' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'nip' => $request->nip,
        ];

        if ($request->hasFile('tanda_tangan')) {
            if ($pejabat->tanda_tangan && Storage::disk('public')->exists($pejabat->tanda_tangan)) {
                Storage::disk('public')->delete($pejabat->tanda_tangan);
            }
            $path = $request->file('tanda_tangan')->store('ttd', 'public');
            $data['tanda_tangan'] = $path;
        }

        $pejabat->update($data);
        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pejabat = Pejabat::findOrFail($id);
        if ($pejabat->tanda_tangan && Storage::disk('public')->exists($pejabat->tanda_tangan)) {
            Storage::disk('public')->delete($pejabat->tanda_tangan);
        }
        $pejabat->delete();
        return redirect()->route('admin.pejabat.index')->with('success', 'Pejabat berhasil dihapus');
    }
}