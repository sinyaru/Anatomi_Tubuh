<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organ;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Schema;

class OrganPenggunaController extends Controller
{
    // ============================================================
    // 1️⃣ Ambil semua kategori organ
    // ============================================================
    public function kategori()
    {
        return response()->json([
            'status' => true,
            'data'   => Kategori::all()
        ]);
    }

    // ============================================================
    // 2️⃣ Ambil organ berdasarkan kategori
    // ============================================================
    public function organByKategori($id)
    {
        $kategori = Kategori::find($id);

        if (!$kategori) {
            return response()->json(['status' => false, 'message' => 'Kategori tidak ditemukan'], 404);
        }

        $organs = Organ::where('kategori_id', $id)->get();

        return response()->json([
            'status'   => true,
            'kategori' => $kategori,
            'organs'   => $organs
        ]);
    }

    // ============================================================
    // 3️⃣ Detail organ + informasi tambahan
    // ============================================================
    public function detail($id)
    {
        $organ = Organ::find($id);

        if (!$organ) {
            return response()->json(['status' => false, 'message' => 'Organ tidak ditemukan'], 404);
        }

        $informasi = [];
        if (Schema::hasTable('informasis')) {
            $informasi = Informasi::where('organ_id', $id)->get();
        }

        return response()->json([
            'status'    => true,
            'organ'     => $organ,
            'informasi' => $informasi
        ]);
    }
}
