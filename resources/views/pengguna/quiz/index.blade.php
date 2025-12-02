@extends('layouts.pengguna')

@section('title', 'Quiz Interaktif')

@section('content')

<style>
    /* Animasi masuk */
    @keyframes pinkPopupIn {
        0% {
            transform: scale(0.6);
            opacity: 0;
        }

        70% {
            transform: scale(1.05);
            opacity: 1;
        }

        100% {
            transform: scale(1);
        }
    }

    /* Animasi keluar */
    @keyframes pinkPopupOut {
        0% {
            transform: scale(1);
            opacity: 1;
        }

        100% {
            transform: scale(0.6);
            opacity: 0;
        }
    }

    /* Terapkan ke SweetAlert box */
    .swal2-popup.pink-anim-in {
        animation: pinkPopupIn 0.25s ease-out forwards;
    }

    .swal2-popup.pink-anim-out {
        animation: pinkPopupOut 0.2s ease-in forwards;
    }
</style>

<div class="container mt-5">

    {{-- JUDUL KIRI ATAS --}}
    <div class="d-flex align-items-center mb-4">
        <img src="https://img.icons8.com/fluency/48/clock.png" class="me-2">
        <h4 class="mb-0">Waktunya Quiz</h4>
    </div>

    <div class="row g-4">
        @foreach($quizzes as $quiz)

        @php
        $sudah = false;
        foreach($quizSelesai as $kode){
        if(str_contains($kode, 'Q'.$quiz->tipe.'-U'.Auth::id())){
        $sudah = true;
        }
        }
        @endphp

        <div class="col-md-4">
            <div class="card p-4 shadow-sm text-center"
                style="border-radius:15px; background:#fff0f6;">

                <h5 class="mt-2">
                    Quiz {{ is_numeric($quiz->tipe) ? 'Tipe '.$quiz->tipe : ucfirst($quiz->tipe) }}
                </h5>

                @if($sudah)
                <span class="badge bg-success mt-2">
                    ✅ Sudah Dikerjakan
                </span>

                <button class="btn btn-warning mt-3"
                    onclick="confirmUlangi('{{ route('pengguna.quiz.ulangi', $quiz->tipe) }}')">
                    🔁 Ulangi Quiz
                </button>
                @else
                <a href="{{ route('pengguna.quiz.show', $quiz->tipe) }}"
                    class="btn mt-3"
                    style="background:#ff69b4; color:white;">
                    ▶ Mulai Quiz
                </a>
                @endif

            </div>
        </div>
        @endforeach
    </div>
</div>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmUlangi(url) {
        Swal.fire({
            title: 'Ulangi Quiz?',
            text: 'Kamu sudah mengerjakan quiz ini. Hasil sebelumnya akan dihapus.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ulangi',
            cancelButtonText: 'Tidak',
            confirmButtonColor: '#ff69b4',
            cancelButtonColor: '#6c757d'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }
</script>

{{-- HASIL QUIZ --}}
@if(session('hasil_quiz'))
<script>
    Swal.fire({
        title: '<span style="font-size:30px; font-weight:600; color:#ff4d88; font-family:serif;">HASIL QUIZ</span>',
        html: `
        <div style="
            background:#ffe6f0;
            padding:25px;
            border-radius:18px;
            text-align:center;
            box-shadow:0 0 10px rgba(255, 105, 180, 0.3);
        ">
            <div style="
                background:white;
                padding:25px;
                border-radius:15px;
                margin-bottom:20px;
                font-size:18px;
                box-shadow:0 0 10px rgba(255, 105, 180, 0.2);
            ">
                <p>Skor Kamu : <strong style="color:#ff4d88;">{{ session('skor') }}/100</strong></p>

                <p>
                    Status :
                    <strong>
                        {!! session('status') === 'Lulus'
                            ? '<span style="color:#00b33c;">&#10004; Lulus</span>'
                            : '<span style="color:#e6004c;">&#10006; Tidak Lulus</span>'
                        !!}
                    </strong>
                </p>

                <p>Durasi : <strong style="color:#ff4d88;">{{ session('durasi') }}</strong></p>
            </div>

            <div style="display:flex; gap:15px; justify-content:center;">
                <a href="{{ route('pengguna.quiz.index', session('tipe_quiz')) }}" 
                   style="
                       padding:10px 22px;
                       background:#ff99c2;
                       color:white;
                       border-radius:10px;
                       text-decoration:none;
                       font-weight:600;
                       box-shadow:0 4px 8px rgba(255, 105, 180, 0.3);
                       transition:.2s;
                   ">
                   Ulangi Quiz
                </a>

                <a href="{{ route('pengguna.dashboard') }}"
                   style="
                       padding:10px 22px;
                       background:#ffb3d9;
                       color:white;
                       border-radius:10px;
                       text-decoration:none;
                       font-weight:600;
                       box-shadow:0 4px 8px rgba(255, 105, 180, 0.25);
                       transition:.2s;
                   ">
                   Home
                </a>
            </div>
        </div>
    `,
        background: '#fff0f6',
        showConfirmButton: false,

        didOpen: () => {
            const popup = Swal.getPopup();
            popup.classList.add('pink-anim-in');
        },
        willClose: () => {
            const popup = Swal.getPopup();
            popup.classList.remove('pink-anim-in');
            popup.classList.add('pink-anim-out');
        }
    });
</script>
@endif


@endsection