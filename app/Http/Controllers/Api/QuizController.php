<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // ================================
    // GET: Semua Quiz
    // ================================
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Quiz::orderBy('created_at', 'desc')->get()
        ]);
    }

    // ================================
    // GET: Detail Quiz
    // ================================
    public function show($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'status' => true,
            'data' => $quiz
        ]);
    }

    // ================================
    // POST: Tambah Quiz
    // ================================
    public function store(Request $request)
    {
        $request->validate([
            'soal' => 'required',
            'tipe' => 'required|in:pilihan,true_false',
            'jawaban_benar' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika pilihan ganda, wajib opsi
        if ($request->tipe === 'pilihan') {
            $request->validate([
                'opsi_a' => 'required',
                'opsi_b' => 'required',
                'opsi_c' => 'required',
                'opsi_d' => 'required',
            ]);
        }

        // Upload foto jika ada
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFoto);
        }

        $quiz = Quiz::create([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe' => $request->tipe,
            'foto' => $namaFoto,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Quiz berhasil ditambahkan',
            'data' => $quiz
        ]);
    }

    // ================================
    // POST/PUT: Update Quiz
    // ================================
    public function update(Request $request, $id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'soal' => 'required',
            'jawaban_benar' => 'required',
            'tipe' => 'required|in:pilihan,true_false',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Jika pilihan ganda, wajib opsi
        if ($request->tipe === 'pilihan') {
            $request->validate([
                'opsi_a' => 'required',
                'opsi_b' => 'required',
                'opsi_c' => 'required',
                'opsi_d' => 'required',
            ]);
        }

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFoto);

            $quiz->foto = $namaFoto;
        }

        $quiz->update([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe' => $request->tipe
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Quiz berhasil diperbarui',
            'data' => $quiz
        ]);
    }

    // ================================
    // DELETE: Hapus Quiz
    // ================================
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'status' => false,
                'message' => 'Quiz tidak ditemukan'
            ], 404);
        }

        $quiz->delete();

        return response()->json([
            'status' => true,
            'message' => 'Quiz berhasil dihapus'
        ]);
    }
}
