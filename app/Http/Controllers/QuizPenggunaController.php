<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Quiz;
use App\Models\HasilQuiz;

class QuizPenggunaController extends Controller
{
    // =======================
    // LIST QUIZ
    // =======================
    public function index()
    {
        $quizzes = Quiz::select('tipe')->distinct()->get();

        $quizSelesai = HasilQuiz::where('nama', Auth::user()->name)
            ->pluck('no')
            ->toArray();

        return view('pengguna.quiz.index', compact('quizzes', 'quizSelesai'));
    }

    // =======================
    // TAMPILKAN QUIZ
    // =======================
    public function show($id)
    {
        // Cek apakah quiz sudah dikerjakan
        $sudah = HasilQuiz::where('nama', Auth::user()->name)
            ->where('no', 'like', 'Q' . $id . '-U' . Auth::id() . '%')
            ->first();

        if ($sudah) {
            return redirect()
                ->route('pengguna.quiz.index')
                ->with([
                    'hasil_quiz' => true,
                    'quiz_id'   => $id,
                    'skor'      => $sudah->skor,
                    'durasi'    => $sudah->durasi,
                    'status'    => $sudah->status,
                ]);
        }

        // Ambil soal
        $soals = Quiz::where('tipe', $id)
            ->inRandomOrder()
            ->take(10)
            ->get();

        if ($soals->count() === 0) {
            return redirect()->back()->with('error', 'Soal belum tersedia.');
        }

        // Simpan session
        session([
            'quiz_soal_' . $id  => $soals->pluck('id')->toArray(),
            'quiz_start_' . $id => now(),
        ]);

        return view('pengguna.quiz.show', compact('soals', 'id'));
    }

    // =======================
    // SUBMIT QUIZ
    // =======================
    public function submit(Request $request, $id)
    {
        $jawaban = $request->jawaban ?? [];
        $soalIds = session('quiz_soal_' . $id);

        if (!$soalIds) {
            return redirect()
                ->route('pengguna.quiz.index')
                ->with('error', 'Session quiz habis.');
        }

        $soals = Quiz::whereIn('id', $soalIds)->get();

        $benar = 0;
        foreach ($soals as $soal) {
            if (
                isset($jawaban[$soal->id]) &&
                $jawaban[$soal->id] == $soal->jawaban_benar
            ) {
                $benar++;
            }
        }

        // Hitung skor
        $skor = round(($benar / count($soals)) * 100);
        $status = $skor >= 60 ? 'Lulus' : 'Tidak Lulus';

        // =======================
        // HITUNG DURASI (MENIT & DETIK)
        // =======================
        $start = session('quiz_start_' . $id);

        if ($start) {
            $totalDetik = abs(now()->diffInSeconds($start));

            $menit = floor($totalDetik / 60);
            $detik = $totalDetik % 60;

            $durasi = $menit . ' menit ' . $detik . ' detik';
        } else {
            $durasi = '-';
        }

        // Nomor unik hasil quiz
        $nomor = 'Q' . $id . '-U' . Auth::id() . '-' . time();

        // Simpan hasil
        HasilQuiz::create([
            'no'     => $nomor,
            'nama'   => Auth::user()->name,
            'durasi' => $durasi,
            'skor'   => $skor,
            'status' => $status,
        ]);

        // Hapus session
        session()->forget(['quiz_soal_' . $id, 'quiz_start_' . $id]);

        return redirect()
            ->route('pengguna.quiz.index')
            ->with([
                'hasil_quiz' => true,
                'quiz_id' => $id,
                'skor'    => $skor,
                'durasi'  => $durasi,
                'status'  => $status,
            ]);
    }

    // =======================
    // ULANGI QUIZ
    // =======================
    public function ulangi($id)
    {
        HasilQuiz::where('nama', Auth::user()->name)
            ->where('no', 'like', 'Q' . $id . '-U' . Auth::id() . '%')
            ->delete();

        session()->forget(['quiz_soal_' . $id, 'quiz_start_' . $id]);

        return redirect()->route('pengguna.quiz.show', $id);
    }
}
