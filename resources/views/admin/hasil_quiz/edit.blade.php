@extends('layouts.admin')

@section('title', 'Edit Hasil Quiz')

@section('content')

<style>
    .quiz-container {
        background-color: #fff0f6;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 600px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #4a4a4a;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 2px solid #f8bbd0;
        border-radius: 8px;
        font-size: 14px;
        transition: .2s;
    }

    .form-control:focus {
        outline: none;
        border-color: #ec407a;
        box-shadow: 0 0 0 3px rgba(236, 64, 122, 0.1);
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
        cursor: pointer;
        font-size: 14px;
    }

    .btn-pink:hover {
        background-color: #d81b60;
    }

    .btn-secondary {
        background-color: #6c757d;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
        text-decoration: none;
        display: inline-block;
        font-size: 14px;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
        color: white;
    }

    .form-actions {
        margin-top: 30px;
        display: flex;
        gap: 10px;
    }

    .page-title {
        color: #ec407a;
        font-weight: 700;
        margin-bottom: 25px;
        font-size: 24px;
    }

    .form-hint {
        color: #6c757d;
        font-size: 12px;
        margin-top: 5px;
    }

    .error-message {
        color: #dc3545;
        font-size: 12px;
        margin-top: 5px;
    }
</style>

<div class="quiz-container">
    <h2 class="page-title">Edit Hasil Quiz</h2>

    <form action="{{ route('hasil-quiz.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" 
                   id="nama" 
                   name="nama" 
                   class="form-control @error('nama') is-invalid @enderror" 
                   value="{{ old('nama', $user->nama) }}" 
                   required>
            @error('nama')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="durasi">Durasi</label>
            <input type="text" 
                   id="durasi" 
                   name="durasi" 
                   class="form-control @error('durasi') is-invalid @enderror" 
                   value="{{ old('durasi', $user->durasi) }}" 
                   required
                   placeholder="Contoh: 10 menit 18 detik">
            @error('durasi')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="skor">Skor</label>
            <input type="number" 
                   id="skor" 
                   name="skor" 
                   class="form-control @error('skor') is-invalid @enderror" 
                   value="{{ old('skor', $user->skor) }}" 
                   min="0" 
                   max="100" 
                   required>
            <div class="form-hint">
                Status akan otomatis diupdate: Lulus (≥60) atau Tidak Lulus (<60)
            </div>
            @error('skor')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-pink">
                Simpan Perubahan
            </button>
            <a href="{{ route('hasil-quiz.index') }}" class="btn-secondary">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection