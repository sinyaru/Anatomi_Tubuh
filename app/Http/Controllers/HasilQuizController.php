<?php

namespace App\Http\Controllers;

use App\Models\HasilQuiz;
use Illuminate\Http\Request;

class HasilQuizController extends Controller
{
    // Tampilkan semua hasil quiz
    public function index()
    {
        $data = HasilQuiz::orderBy('created_at', 'DESC')->get();
        return view('admin.hasil_quiz.index', compact('data'));
    }

    // Tampilkan detail hasil quiz user tertentu
    public function show($id)
    {
        $user = HasilQuiz::findOrFail($id);
        return view('admin.hasil_quiz.show', compact('user'));
    }

    // Tampilkan form edit hasil quiz
    public function edit($id)
    {
        $user = HasilQuiz::findOrFail($id);
        return view('admin.hasil_quiz.edit', compact('user'));
    }

    // Update hasil quiz
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'durasi' => 'required|string',
            'skor' => 'required|numeric|min:0|max:100',
        ]);

        $hasilQuiz = HasilQuiz::findOrFail($id);
        
        // Update data
        $hasilQuiz->nama = $request->nama;
        $hasilQuiz->durasi = $request->durasi;
        $hasilQuiz->skor = $request->skor;
        
        // Otomatis update status berdasarkan skor
        $hasilQuiz->status = $request->skor >= 60 ? 'Lulus' : 'Tidak Lulus';
        
        $hasilQuiz->save();

        return redirect()->route('hasil-quiz.index')
                         ->with('success', 'Data berhasil diupdate!');
    }

    // Hapus hasil quiz
    public function destroy($id)
    {
        $hasilQuiz = HasilQuiz::findOrFail($id);
        $hasilQuiz->delete();

        return redirect()->route('hasil-quiz.index')
                         ->with('success', 'Data berhasil dihapus!');
    }
}