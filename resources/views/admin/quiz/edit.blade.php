@extends('layouts.admin')

@section('title', 'Edit Quiz')

@section('content')

<style>
    .form-card {
        border: 2px solid #e1b0c8;
        border-radius: 12px;
        padding: 22px;
        background: #fff;
    }

    .title-box {
        font-size: 20px;
        font-weight: 600;
        margin-bottom: 15px;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 9px 18px;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div class="container">

    <div class="form-card">

        <div class="title-box">Edit Quiz</div>

        <form action="{{ route('quiz.update', $quiz->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- Soal --}}
            <div class="mb-3">
                <label class="form-label">Soal</label>
                <textarea name="soal" class="form-control" required>{{ $quiz->soal }}</textarea>
            </div>

            {{-- Foto Lama --}}
            @if ($quiz->foto)
            <div class="mb-3">
                <label class="form-label">Foto Saat Ini:</label><br>
                <img src="{{ asset('uploads/' . $quiz->foto) }}" width="200" class="img-thumbnail mb-2 rounded">
            </div>
            @endif

            {{-- Upload Foto Baru --}}
            <div class="mb-3">
                <label class="form-label">Ganti Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

            {{-- Tipe Soal --}}
            <div class="mb-3">
                <label class="form-label">Tipe Soal</label>
                <input type="text" class="form-control" value="{{ $quiz->tipe }}" disabled>

                <input type="hidden" name="tipe" value="{{ $quiz->tipe }}">
            </div>

            @if ($quiz->tipe == 'pilihan_ganda')

            <div class="title-box mt-3">Pilihan Ganda</div>

            <div class="mb-3">
                <label class="form-label">Opsi A</label>
                <input type="text" name="opsi_a" class="form-control" value="{{ $quiz->opsi_a }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Opsi B</label>
                <input type="text" name="opsi_b" class="form-control" value="{{ $quiz->opsi_b }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Opsi C</label>
                <input type="text" name="opsi_c" class="form-control" value="{{ $quiz->opsi_c }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Opsi D</label>
                <input type="text" name="opsi_d" class="form-control" value="{{ $quiz->opsi_d }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Jawaban Benar (A/B/C/D)</label>
                <select name="jawaban_benar" class="form-control" required>
                    <option value="A" {{ $quiz->jawaban_benar == 'A' ? 'selected' : '' }}>A</option>
                    <option value="B" {{ $quiz->jawaban_benar == 'B' ? 'selected' : '' }}>B</option>
                    <option value="C" {{ $quiz->jawaban_benar == 'C' ? 'selected' : '' }}>C</option>
                    <option value="D" {{ $quiz->jawaban_benar == 'D' ? 'selected' : '' }}>D</option>
                </select>
            </div>

            @endif

            @if ($quiz->tipe == 'true_false')

            <div class="title-box mt-3">True / False</div>

            <div class="mb-3">
                <label class="form-label">Jawaban Benar</label>
                <select name="jawaban_benar" class="form-control" required>
                    <option value="true" {{ $quiz->jawaban_benar == 'true' ? 'selected' : '' }}>True</option>
                    <option value="false" {{ $quiz->jawaban_benar == 'false' ? 'selected' : '' }}>False</option>
                </select>
            </div>

            @endif

            <button type="submit" class="btn-pink">Update</button>
            <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Batal</a>

        </form>
    </div>

</div>

@endsection