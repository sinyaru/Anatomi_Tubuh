@extends('layouts.pengguna')

@section('title', 'Kerjakan Quiz')

@section('content')
<div class="container mt-5">

    {{-- JUDUL --}}
    <div class="d-flex align-items-center mb-3">
        <img src="https://img.icons8.com/fluency/48/clock.png" class="me-2">
        <h4 class="mb-0">Waktunya Quiz</h4>
    </div>

    <div class="card shadow-lg" style="border-radius:20px; background:#fff0f6;">
        <div class="card-body p-4">

            {{-- TIMER --}}
            <div class="d-flex justify-content-end mb-3">
                <span class="badge bg-danger">
                    Waktu Soal: <span id="timer">10</span> dtk
                </span>
            </div>

            <form id="quizForm" action="{{ route('pengguna.quiz.submit', $id) }}" method="POST">
                @csrf

                @foreach($soals as $i => $q)
                <div class="question {{ $i == 0 ? '' : 'd-none' }}">
                    <h5>Soal {{ $i + 1 }}</h5>
                    <p>{{ $q->soal }}</p>

                    {{-- FOTO JIKA ADA --}}
                    @if($q->foto)
                    <div class="text-center my-3">
                        <img src="{{ asset('uploads/'.$q->foto) }}"
                            class="img-fluid rounded"
                            style="max-height:250px;">
                    </div>
                    @endif

                    {{-- ================================== --}}
                    {{-- OPSI JAWABAN BERDASARKAN TIPE SOAL --}}
                    {{-- ================================== --}}
                    @php
                    $tipe = strtolower(trim($q->tipe));
                    @endphp

                    @if(in_array($tipe, ['true_false', 'tf', 'truefalse', 'true-false']))
                    {{-- 🔵 TRUE / FALSE --}}
                    <div class="row">
                        <div class="col-6 mb-2">
                            <label class="option-box w-100 p-3 rounded">
                                <input type="radio"
                                    name="jawaban[{{ $q->id }}]"
                                    value="true"
                                    class="d-none">
                                <strong>T.</strong> Benar
                            </label>
                        </div>

                        <div class="col-6 mb-2">
                            <label class="option-box w-100 p-3 rounded">
                                <input type="radio"
                                    name="jawaban[{{ $q->id }}]"
                                    value="false"
                                    class="d-none">
                                <strong>F.</strong> Salah
                            </label>
                        </div>
                    </div>

                    @else
                    {{-- 🔴 PILIHAN GANDA --}}
                    <div class="row">
                        @foreach(['a','b','c','d'] as $opsi)
                        <div class="col-6 mb-2">
                            <label class="option-box w-100 p-3 rounded">
                                <input type="radio"
                                    name="jawaban[{{ $q->id }}]"
                                    value="{{ $q['opsi_'.$opsi] }}"
                                    class="d-none">
                                <strong>{{ strtoupper($opsi) }}.</strong>
                                {{ $q['opsi_'.$opsi] }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
                @endforeach

                {{-- NAVIGASI --}}
                <div class="d-flex justify-content-between mt-4">
                    <button type="button" class="btn btn-secondary" id="prev">Sebelumnya</button>
                    <button type="button" class="btn btn-primary" id="next">Selanjutnya</button>
                    <button type="submit" class="btn btn-success d-none" id="submitBtn">
                        Selesai
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

{{-- SCRIPT --}}
<script>
    let current = 0;
    let questions = document.querySelectorAll('.question');
    let total = questions.length;

    let waktuSoal = 10;
    let interval;
    const timerEl = document.getElementById('timer');

    function tampilSoal(i) {
        questions.forEach(q => q.classList.add('d-none'));
        questions[i].classList.remove('d-none');

        document.getElementById('prev').disabled = i === 0;
        document.getElementById('next').classList.toggle('d-none', i === total - 1);
        document.getElementById('submitBtn').classList.toggle('d-none', i !== total - 1);

        resetTimer();
    }

    function resetTimer() {
        clearInterval(interval);
        waktuSoal = 10;
        timerEl.innerText = waktuSoal;

        interval = setInterval(() => {
            waktuSoal--;
            timerEl.innerText = waktuSoal;

            if (waktuSoal <= 0) {
                clearInterval(interval);

                if (current < total - 1) {
                    current++;
                    tampilSoal(current);
                } else {
                    document.getElementById('quizForm').submit();
                }
            }
        }, 1000);
    }

    document.getElementById('prev').onclick = () => {
        if (current > 0) {
            current--;
            tampilSoal(current);
        }
    };

    document.getElementById('next').onclick = () => {
        if (current < total - 1) {
            current++;
            tampilSoal(current);
        }
    };

    tampilSoal(0);
</script>

<style>
    .option-box {
        background: white;
        border: 2px solid #ffd6e6;
        cursor: pointer;
    }

    .option-box:hover {
        background: #ffd6e6;
    }

    .option-box:has(input:checked) {
        background: #ff69b4;
        color: white;
    }
</style>
@endsection