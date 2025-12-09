<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Informasi;
use Illuminate\Http\Request;

class InformasiController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Informasi::orderBy('created_at', 'desc')->get()
        ]);
    }

    public function show($id)
    {
        $info = Informasi::find($id);

        if (!$info) {
            return response()->json(['status' => false, 'message' => 'Informasi tidak ditemukan'], 404);
        }

        return response()->json(['status' => true, 'data' => $info]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'email' => 'required|email',
            'nama' => 'required'
        ]);

        $data = Informasi::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'email' => $request->email,
            'nama' => $request->nama,
            'role' => $request->user()->role,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Informasi berhasil ditambahkan',
            'data' => $data
        ]);
    }

    public function update(Request $request, $id)
    {
        $info = Informasi::find($id);

        if (!$info) return response()->json(['status' => false, 'message' => 'Informasi tidak ditemukan'], 404);

        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'required',
            'tanggal' => 'required|date',
            'email' => 'required|email',
            'nama' => 'required'
        ]);

        $info->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'email' => $request->email,
            'nama' => $request->nama,
            'role' => $request->user()->role
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Informasi berhasil diperbarui',
            'data' => $info
        ]);
    }

    public function destroy($id)
    {
        $info = Informasi::find($id);

        if (!$info) return response()->json(['status' => false, 'message' => 'Informasi tidak ditemukan'], 404);

        $info->delete();

        return response()->json([
            'status' => true,
            'message' => 'Informasi berhasil dihapus'
        ]);
    }
}
