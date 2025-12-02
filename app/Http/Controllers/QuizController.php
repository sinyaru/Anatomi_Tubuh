<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quiz = Quiz::all();
        return view('admin.quiz.index', compact('quiz'));
    }

    public function create()
    {
        return view('admin.quiz.create');
    }

    public function store(Request $request)
    {
        $tipe = $request->tipe === 'pilihan' ? 'pilihan_ganda' : 'true_false';

        $rules = [
            'soal' => 'required',
            'tipe' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ];

        // Validasi sesuai tipe
        if ($tipe === 'pilihan_ganda') {
            $rules['jawaban_benar'] = 'required';
            $rules['opsi_a'] = 'required';
            $rules['opsi_b'] = 'required';
            $rules['opsi_c'] = 'required';
            $rules['opsi_d'] = 'required';
        } else {
            $rules['jawaban_benar'] = 'required|in:true,false';
        }

        $request->validate($rules);

        // Upload foto
        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFoto);
        }

        Quiz::create([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $tipe === 'pilihan_ganda' ? $request->opsi_a : null,
            'opsi_b' => $tipe === 'pilihan_ganda' ? $request->opsi_b : null,
            'opsi_c' => $tipe === 'pilihan_ganda' ? $request->opsi_c : null,
            'opsi_d' => $tipe === 'pilihan_ganda' ? $request->opsi_d : null,
            'tipe' => $tipe,
            'foto' => $namaFoto,
        ]);

        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil ditambahkan');
    }

    public function edit($id)
    {
        $quiz = Quiz::findOrFail($id);
        return view('admin.quiz.edit', compact('quiz'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'soal' => 'required',
            'jawaban_benar' => 'required',
            'tipe' => 'required',
            'foto' => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $quiz = Quiz::findOrFail($id);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $namaFoto = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $namaFoto);

            $quiz->foto = $namaFoto;
        }

        $quiz->update([
            'soal' => $request->soal,
            'jawaban_benar' => $request->jawaban_benar,
            'opsi_a' => $request->opsi_a,
            'opsi_b' => $request->opsi_b,
            'opsi_c' => $request->opsi_c,
            'opsi_d' => $request->opsi_d,
            'tipe' => $request->tipe,
        ]);

        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil diperbarui');
    }


    public function destroy($id)
    {
        Quiz::findOrFail($id)->delete();

        return redirect()->route('quiz.index')->with('success', 'Quiz berhasil dihapus');
    }
}