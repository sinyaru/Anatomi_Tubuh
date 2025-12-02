<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\HasilQuiz;
use App\Models\Quiz;

class DashboardPenggunaController extends Controller
{
    public function index()
    {
        $nama = Auth::user()->name;

        // ✅ TOTAL POIN OTOMATIS
        $totalPoin = HasilQuiz::where('nama', $nama)->sum('skor') ?? 0;

        // ✅ JUMLAH QUIZ SELESAI
        $jumlahQuiz = HasilQuiz::where('nama', $nama)->count() ?? 0;

        // ✅ RANKING OTOMATIS SELURUH USER
        $rankingData = HasilQuiz::select('nama', DB::raw('SUM(skor) as total'))
            ->groupBy('nama')
            ->orderByDesc('total')
            ->get();

        $peringkat = $rankingData->search(function ($item) use ($nama) {
            return $item->nama === $nama;
        });

        $peringkat = $peringkat !== false ? $peringkat + 1 : $rankingData->count() + 1;

        // ✅ MATERI DIPELAJARI
        $materiDipilih = HasilQuiz::where('nama', $nama)
            ->distinct('no')
            ->count('no') ?? 0;

        // ✅ AKTIVITAS TERBARU
        $aktivitasTerbaru = HasilQuiz::where('nama', $nama)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('pengguna.dashboard', compact(
            'totalPoin',
            'jumlahQuiz',
            'peringkat',
            'materiDipilih',
            'aktivitasTerbaru'
        ));
    }

    // ✅ HALAMAN PROFIL
    public function profil()
    {
        return view('pengguna.profil', [
            'user' => Auth::user()
        ]);
    }

    // ✅ UPDATE PROFIL PENGGUNA (TAMBAHAN)
    public function updateProfil(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6',
        ]);

        // Update nama
        $user->name = $request->name;

        // Update password jika diisi
        if ($request->password) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }
}
