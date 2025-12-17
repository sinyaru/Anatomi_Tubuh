<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Organ;
use App\Models\Quiz;
use App\Models\HasilQuiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function admin()
    {
        return response()->json([
            'totalOrgan' => Organ::count(),
            'totalQuiz' => Quiz::count(),
            'totalPengguna' => User::count(),
            'rataNilai' => round(HasilQuiz::avg('skor'), 1),
            'activity' => HasilQuiz::select(
                DB::raw('DAYNAME(created_at) as hari'),
                DB::raw('COUNT(*) as jumlah')
            )
                ->groupBy('hari')
                ->get()
        ]);
    }
}
