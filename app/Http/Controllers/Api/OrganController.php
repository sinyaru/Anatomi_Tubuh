<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organ;
use Illuminate\Http\Request;

class OrganApiController extends Controller
{
    // ============================
    // GET: Semua data organ
    // ============================
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Organ::with('kategori')->get()
        ]);
    }

    // ============================
    // POST: Tambah organ
    // ============================
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        $organ = Organ::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'foto' => $filename,
            'kategori_id' => $request->kategori_id
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Organ berhasil ditambahkan',
            'data' => $organ
        ]);
    }

    // ============================
    // GET: Detail organ
    // ============================
    public function show($id)
    {
        $data = Organ::with('kategori')->find($id);

        if (!$data) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ]);
    }

    // ============================
    // PUT: Update organ
    // ============================
    public function update(Request $request, $id)
    {
        $data = Organ::find($id);

        if (!$data) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            'foto' => 'nullable|image|max:2048'
        ]);

        // Bila upload foto baru
        if ($request->hasFile('foto')) {
            // hapus foto lama
            if ($data->foto && file_exists(public_path('uploads/' . $data->foto))) {
                unlink(public_path('uploads/' . $data->foto));
            }

            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $data->foto = $filename;
        }

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'kategori_id' => $request->kategori_id,
            'foto' => $data->foto
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Organ berhasil diperbarui',
            'data' => $data
        ]);
    }

    // ============================
    // DELETE: Hapus organ
    // ============================
    public function destroy($id)
    {
        $data = Organ::find($id);

        if (!$data) {
            return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
        }

        if ($data->foto && file_exists(public_path('uploads/' . $data->foto))) {
            unlink(public_path('uploads/' . $data->foto));
        }

        $data->delete();

        return response()->json([
            'status' => true,
            'message' => 'Organ berhasil dihapus'
        ]);
    }
}
