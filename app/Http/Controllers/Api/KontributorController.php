<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organ;
use App\Models\Quiz;
use App\Models\HasilQuiz;

class KontributorController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => true,
            'totalOrgan' => Organ::count(),
            'totalQuiz' => Quiz::count(),
            'rataNilai' => round(HasilQuiz::avg('skor') ?? 0, 1),
            'activity' => HasilQuiz::selectRaw('DAYNAME(created_at) as hari, COUNT(*) as jumlah')
                ->groupBy('hari')
                ->pluck('jumlah', 'hari')
        ]);
    }
}
