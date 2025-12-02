<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Organ;
use App\Models\Quiz;
use App\Models\HasilQuiz;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // TOTAL ORGAN
        $totalOrgan = Organ::count();

        // TOTAL QUIZ
        $totalQuiz = Quiz::count();

        // TOTAL PENGGUNA
        $totalPengguna = User::count();

        // RATA-RATA NILAI QUIZ (Jika kolom skor ada di hasil_quiz)
        $rataNilai = HasilQuiz::avg('skor');
        $rataNilai = round($rataNilai, 1); // dibulatkan 1 angka

        // Grafik Aktivitas (Contoh count quiz per hari)
        $activity = HasilQuiz::selectRaw('DAYNAME(created_at) as hari, COUNT(*) as jumlah')
            ->groupBy('hari')
            ->pluck('jumlah', 'hari');

        return view('admin.dashboard', compact(
            'totalOrgan',
            'totalQuiz',
            'totalPengguna',
            'rataNilai',
            'activity'
        ));
    }
}
