@extends('layouts.pengguna')

@section('title', 'Hasil Quiz')

@section('content')
<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg p-4 text-center"
         style="max-width:450px; border-radius:20px; background:#fff0f6;">

        <h3 class="mb-3">✅ Quiz Selesai</h3>

        <h1 class="fw-bold" style="color:#ff69b4;">
            {{ $skor }}/100
        </h1>

        <p class="mt-2">
            Status:
            @if($skor >= 60)
                <span class="badge bg-success">LULUS</span>
            @else
                <span class="badge bg-danger">TIDAK LULUS</span>
            @endif
        </p>

        <div class="mt-4 d-grid gap-2">
            <a href="{{ route('pengguna.quiz') }}"
               class="btn btn-secondary">
                ⬅ Kembali ke Quiz
            </a>

            <a href="{{ route('pengguna.quiz.show', $quiz_id) }}"
               class="btn btn-warning">
                🔁 Ulangi Quiz
            </a>
        </div>

    </div>
</div>
@endsection
