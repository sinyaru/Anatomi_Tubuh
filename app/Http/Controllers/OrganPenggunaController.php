<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organ;
use App\Models\Informasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Schema;

class OrganPenggunaController extends Controller
{
    /**
     * 1️⃣ Halaman PILIH KATEGORI
     */
    public function kategori()
    {
        $kategoris = Kategori::all(); // Ambil semua kategori dari DB
        return view('pengguna.organ.kategori', compact('kategoris'));
    }

    /**
     * 2️⃣ Tampilkan organ berdasarkan kategori (kategori_id)
     */
    public function index($id)
    {
        // Cari kategori berdasarkan ID
        $kategori = Kategori::findOrFail($id);

        // Ambil organ yang sesuai kategori_id
        $organs = Organ::where('kategori_id', $id)->get();

        return view('pengguna.organ.index', compact('organs', 'kategori'));
    }

    /**
     * 3️⃣ Tampilkan detail organ
     */
    public function show($id)
    {
        $organ = Organ::findOrFail($id);

        // Ambil informasi tambahan
        try {
            if (Schema::hasTable('informasis')) {
                $informasi = Informasi::where('organ_id', $id)->get();
            } else {
                $informasi = collect();
            }
        } catch (\Exception $e) {
            $informasi = collect();
        }

        return view('pengguna.organ.show', compact('organ', 'informasi'));
    }
}
