<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Organ;
use Illuminate\Http\Request;

class OrganKontributorController extends Controller
{
    public function index()
    {
        $data = Organ::all();
        return view('kontributor.organ.index', compact('data'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        return view('kontributor.organ.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'required|image',
            'kategori_id' => 'required'
        ]);

        $file = $request->foto;
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move('uploads', $filename);

        Organ::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('kontributor.organ.index')->with('success', 'Organ berhasil ditambahkan');
    }

    public function edit($id)
    {
        $data = Organ::findOrFail((int)$id);
        $kategori = Kategori::all();
        return view('kontributor.organ.edit', compact('data', 'kategori'));
    }

    public function update(Request $request, $id)
    {
        $data = Organ::findOrFail($id);

        // Validasi ringan (opsional, tidak bikin error)
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'kategori_id' => 'required',
        ]);

        // Jika ada foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($data->foto && file_exists(public_path('uploads/' . $data->foto))) {
                unlink(public_path('uploads/' . $data->foto));
            }

            // Upload foto baru
            $file = $request->foto;
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            // Simpan nama foto baru
            $data->foto = $filename;
        }

        // Update field lainnya
        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $data->foto, // biar tetap aman
            'kategori_id' => $request->kategori_id
        ]);

        return redirect()->route('kontributor.organ.index')->with('success', 'Organ berhasil diperbarui');
    }
    public function destroy($id)
    {
        $data = Organ::findOrFail($id);

        // Hapus foto jika ada
        if ($data->foto && file_exists(public_path('uploads/' . $data->foto))) {
            unlink(public_path('uploads/' . $data->foto));
        }

        // Hapus data dari database
        $data->delete();

        return redirect()->back()->with('success', 'Organ berhasil dihapus');
    }
}
