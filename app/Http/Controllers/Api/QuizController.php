<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    // ============================================================
    // GET ALL QUIZ
    // ============================================================
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Quiz::orderBy('created_at', 'desc')->get()
        ]);
    }

    // ============================================================
    // GET DETAIL QUIZ
    // ============================================================
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

    // ============================================================
    // STORE — UPLOAD FOTO KE SUPABASE
    // ============================================================
    public function store(Request $request)
    {
        $request->validate([
            'soal'           => 'required',
            'tipe'           => 'required|in:pilihan,true_false',
            'jawaban_benar'  => 'required',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        $fileName = null;

        // Jika ada file foto
        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $fileName =
                time() . '_' .
                Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) .
                '.' . $file->getClientOriginalExtension();

            /**
             * ⚠️ Penting:
             * Supabase S3 DISK sudah diarahkan ke BUCKET quiz-images
             * Jadi kita upload ke ROOT "" saja, bukan folder quiz-images.
             */
            Storage::disk('supabase')->put(
                $fileName,
                file_get_contents($file),
                'public'
            );
        }

        $quiz = Quiz::create([
            'soal'          => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a'        => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b'        => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c'        => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d'        => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe'          => $request->tipe,
            'foto'          => $fileName,
        ]);

        return response()->json([
            'status' => true,
            'data'   => $quiz
        ]);
    }

    // ============================================================
    // UPDATE — BISA GANTI FOTO DAN HAPUS FOTO LAMA
    // ============================================================
    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'soal'           => 'required',
            'jawaban_benar'  => 'required',
            'tipe'           => 'required|in:pilihan,true_false',
            'foto'           => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus file lama
            if ($quiz->foto && Storage::disk('supabase')->exists($quiz->foto)) {
                Storage::disk('supabase')->delete($quiz->foto);
            }

            $file = $request->file('foto');

            $fileName =
                time() . '_' .
                Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) .
                '.' . $file->getClientOriginalExtension();

            // Upload baru
            Storage::disk('supabase')->put(
                $fileName,
                file_get_contents($file),
                'public'
            );

            $quiz->foto = $fileName;
        }

        $quiz->update([
            'soal'          => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a'        => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b'        => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c'        => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d'        => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe'          => $request->tipe,
            'foto'          => $quiz->foto,
        ]);

        return response()->json([
            'status' => true,
            'data'   => $quiz
        ]);
    }

    // ============================================================
    // DELETE — HAPUS FOTO DI SUPABASE
    // ============================================================
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json([
                'status'  => false,
                'message' => 'Quiz tidak ditemukan'
            ], 404);
        }

        // Hapus foto di supabase
        if ($quiz->foto && Storage::disk('supabase')->exists($quiz->foto)) {
            Storage::disk('supabase')->delete($quiz->foto);
        }

        $quiz->delete();

        return response()->json([
            'status'  => true,
            'message' => 'Quiz berhasil dihapus'
        ]);
    }
}
