@extends('layouts.pengguna')

@section('title', 'Hasil Quiz')

@section('content')
<div class="container mt-5">

    {{-- JUDUL --}}
    <div class="d-flex align-items-center mb-4">
        <img src="https://img.icons8.com/fluency/48/test.png" class="me-2">
        <h4 class="mb-0">Hasil Quiz Kamu</h4>
    </div>

    {{-- RINGKASAN --}}
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4" style="border-radius:15px;background:#fff0f6;">
                <img src="https://img.icons8.com/fluency/64/trophy.png">
                <h6 class="mt-2">Total Poin</h6>
                <h3 class="fw-bold text-success">{{ $totalPoin }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4" style="border-radius:15px;background:#f0f9ff;">
                <img src="https://img.icons8.com/fluency/64/task.png">
                <h6 class="mt-2">Jumlah Quiz</h6>
                <h3 class="fw-bold">{{ $jumlahQuiz }}</h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4" style="border-radius:15px;background:#f6fff0;">
                <img src="https://img.icons8.com/fluency/64/statistics.png">
                <h6 class="mt-2">Rata-rata</h6>
                <h3 class="fw-bold text-primary">
                    {{ $jumlahQuiz > 0 ? round($totalPoin / $jumlahQuiz) : 0 }}
                </h3>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center p-4" style="border-radius:15px;background:#fff;">
                <img src="https://img.icons8.com/fluency/64/calendar.png">
                <h6 class="mt-2">Quiz Terakhir</h6>
                <p class="fw-semibold mb-0">
                    {{ $hasilQuiz->first()?->created_at->format('d M Y') ?? '-' }}
                </p>
            </div>
        </div>
    </div>

    {{-- LIST HASIL --}}
    <div class="row g-4">
        @forelse($hasilQuiz as $hasil)
        <div class="col-md-6">
            <div class="card shadow-sm p-4" style="border-radius:15px;">
                <h5 class="fw-semibold mb-2">
                    📝 {{ $hasil->quiz?->judul ?? 'Quiz Interaktif' }}
                </h5>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <span class="fw-bold fs-5">
                        Skor: 
                        <span class="text-success">{{ $hasil->skor }}</span>
                    </span>

                    <span class="badge 
                        {{ $hasil->status == 'Lulus' ? 'bg-success' : 'bg-danger' }}">
                        {{ $hasil->status }}
                    </span>
                </div>

                <ul class="list-unstyled mb-0">
                    <li>⏱ Durasi: <strong>{{ $hasil->durasi }}</strong></li>
                    <li>📅 Tanggal: {{ $hasil->created_at->format('d M Y H:i') }}</li>
                </ul>
            </div>
        </div>
        @empty
        <div class="col-12 text-center mt-5">
            <img src="https://img.icons8.com/fluency/96/empty.png">
            <p class="mt-3 text-muted">Belum ada hasil quiz</p>
        </div>
        @endforelse
    </div>

</div>
@endsection
