@extends('layouts.admin')

@section('title', 'Tambah Quiz')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

<style>
    .tab-btn {
        background-color: #e0e0e0;
        border: none;
        padding: 8px 14px;
        border-radius: 6px;
        margin-right: 5px;
        font-weight: 600;
        cursor: pointer;
    }

    .tab-btn.active {
        background-color: #ec407a;
        color: white;
    }

    .form-card {
        border: 2px solid #e1b0c8;
        border-radius: 10px;
        padding: 20px;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
    }
</style>

<div x-data="{ tipe: 'pilihan' }" class="quiz-container">

    <!-- Tabs -->
    <div class="mb-3">
        <button class="tab-btn" :class="{ 'active': tipe === 'pilihan' }" @click="tipe = 'pilihan'">
            Pilihan Ganda
        </button>

        <button class="tab-btn" :class="{ 'active': tipe === 'truefalse' }" @click="tipe = 'truefalse'">
            False Or True
        </button>
    </div>

    <!-- Form -->
    <form action="{{ route('quiz.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name="tipe" :value="tipe">

        <div class="form-card">

            <!-- FOTO -->
            <div class="mb-3">
                <label class="form-label">Foto (opsional)</label>
                <input type="file" name="foto" class="form-control">
            </div>

            <!-- Soal -->
            <div class="mb-3">
                <label class="form-label">Soal</label>
                <input type="text" name="soal" class="form-control" required>
            </div>

            <!-- MODE PILIHAN GANDA -->
            <div x-show="tipe === 'pilihan'" x-transition>
                <div class="mb-3">
                    <label class="form-label">Jawaban Benar</label>
                    <input type="text" name="jawaban_benar" class="form-control"
                        :disabled="tipe !== 'pilihan'">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-2">
                        <label>Opsi A</label>
                        <input type="text" name="opsi_a" class="form-control" :disabled="tipe !== 'pilihan'">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Opsi B</label>
                        <input type="text" name="opsi_b" class="form-control" :disabled="tipe !== 'pilihan'">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Opsi C</label>
                        <input type="text" name="opsi_c" class="form-control" :disabled="tipe !== 'pilihan'">
                    </div>
                    <div class="col-md-6 mb-2">
                        <label>Opsi D</label>
                        <input type="text" name="opsi_d" class="form-control" :disabled="tipe !== 'pilihan'">
                    </div>
                </div>
            </div>

            <!-- MODE TRUE FALSE -->
            <div x-show="tipe === 'truefalse'" x-transition>
                <div class="mb-3">
                    <label class="form-label">Jawaban Benar</label>
                    <select name="jawaban_benar" class="form-control" :disabled="tipe !== 'truefalse'">
                        <option value="">-- Pilih Jawaban --</option>
                        <option value="true">True</option>
                        <option value="false">False</option>
                    </select>
                </div>
            </div>

            <div class="mt-3">
                <button type="submit" class="btn btn-pink">Simpan</button>
                <a href="{{ route('quiz.index') }}" class="btn btn-secondary">Batal</a>
            </div>

        </div>
    </form>
</div>

@endsection