<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    // GET semua quiz
    public function index()
    {
        return response()->json([
            'status' => true,
            'data' => Quiz::orderBy('created_at', 'desc')->get()
        ]);
    }

    // GET detail
    public function show($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['status' => false, 'message' => 'Quiz tidak ditemukan'], 404);
        }

        return response()->json(['status' => true, 'data' => $quiz]);
    }

    // POST tambah quiz
    public function store(Request $request)
    {
        $request->validate([
            'soal' => 'required',
            'tipe' => 'required|in:pilihan,true_false',
            'jawaban_benar' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fileName = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            // buat nama unik
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();

            // simpan ke supabase bucket
            $path = Storage::disk('supabase')->putFileAs('/', $file, $fileName, ['Visibility' => 'public']);
            // putFileAs dengan '/' akan menaruh di root bucket; path mungkin sama nama file
            // $path berisi nama file (tergantung implementasi) — tetapi kita simpan $fileName di DB
        }

        $quiz = Quiz::create([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe' => $request->tipe,
            'foto' => $fileName,
        ]);

        return response()->json(['status' => true, 'data' => $quiz]);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $request->validate([
            'soal' => 'required',
            'jawaban_benar' => 'required',
            'tipe' => 'required|in:pilihan,true_false',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            // hapus file lama (opsional)
            if ($quiz->foto) {
                // hapus di supabase
                Storage::disk('supabase')->delete($quiz->foto);
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            Storage::disk('supabase')->putFileAs('/', $file, $fileName, ['Visibility' => 'public']);

            $quiz->foto = $fileName;
        }

        $quiz->update([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $request->tipe === 'pilihan' ? $request->opsi_a : null,
            'opsi_b' => $request->tipe === 'pilihan' ? $request->opsi_b : null,
            'opsi_c' => $request->tipe === 'pilihan' ? $request->opsi_c : null,
            'opsi_d' => $request->tipe === 'pilihan' ? $request->opsi_d : null,
            'tipe' => $request->tipe,
            'foto' => $quiz->foto,
        ]);

        return response()->json(['status' => true, 'data' => $quiz]);
    }

    // DELETE quiz
    public function destroy($id)
    {
        $quiz = Quiz::find($id);

        if (!$quiz) {
            return response()->json(['status' => false, 'message' => 'Quiz tidak ditemukan'], 404);
        }

        $quiz->delete();

        return response()->json([
            'status' => true,
            'message' => 'Quiz berhasil dihapus'
        ]);
    }
}
