<?php

namespace App\Http\Controllers;

use App\Models\HasilQuiz;
use Illuminate\Support\Facades\Auth;

class HasilQuizPenggunaController extends Controller
{
    public function index()
    {
        $namaUser = Auth::user()->name;

        // Ambil semua hasil quiz user
        $hasilQuiz = HasilQuiz::where('nama', $namaUser)
            ->orderBy('created_at', 'desc')
            ->get();

        // ✅ HITUNG TOTAL POIN
        $totalPoin = $hasilQuiz->sum('skor');

        // ✅ HITUNG JUMLAH QUIZ
        $jumlahQuiz = $hasilQuiz->count();

        // ✅ RATA-RATA NILAI
        $rataRata = $jumlahQuiz > 0
            ? round($totalPoin / $jumlahQuiz, 1)
            : 0;

        return view('pengguna.hasil-quiz.index', compact(
            'hasilQuiz',
            'totalPoin',
            'jumlahQuiz',
            'rataRata'
        ));
    }
}
