@extends('layouts.pengguna')

@section('title', 'Pilih Kategori Organ')

@section('content')
<div class="container mt-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e;">
            @auth
            Halo, {{ auth()->user()->name }} 👋
            @else
            Selamat Datang di Belajar Organ Tubuh 👋
            @endauth
        </h4>
        <p style="color:#7a4b63; margin-top:-5px;">
            Pilih kategori materi yang ingin kamu pelajari
        </p>
    </div>

    {{-- JUDUL --}}
    <h5 class="mb-4" style="font-family:'Poppins', sans-serif; font-weight:600; color:#4a0d2e;">
        📂 Pilih Kategori Materi
    </h5>

    <div class="row g-4">

        <div class="row justify-content-center g-4">

            @foreach($kategoris as $kategori)
            <div class="col-6 d-flex justify-content-center">

                <a href="{{ route('pengguna.organ.byKategori', $kategori->id) }}"
                    class="text-decoration-none"
                    style="color:inherit;">

                    <div class="shadow-sm d-flex flex-column align-items-center justify-content-center"
                        style="
                    width: 200px;
                    height: 200px;
                    background:#fff0f6;
                    border-radius:20px;
                    border:1px solid #e8b4c9;
                    margin: 8px; 
                    transition:0.2s;
                "
                        onmouseover="this.style.transform='scale(1.07)'"
                        onmouseout="this.style.transform='scale(1)'">

                        {{-- PILIH ICON BERDASARKAN NAMA --}}
                        @php
                        $icon = match(strtolower($kategori->nama)) {
                        'organ dalam' => 'organ-dalam.png',
                        'organ luar' => 'organ-luar.png',
                        'sistem organ' => 'sistem-organ.png',
                        default => 'default.png'
                        };
                        @endphp

                        <img src="{{ asset('icon/' . $icon) }}" width="85" class="mb-2">

                        <span style="font-weight:600; font-size:1rem; color:#4a0d2e;">
                            {{ $kategori->nama }}
                        </span>
                    </div>

                </a>
            </div>
            @endforeach

            {{-- ITEM KHUSUS: LATIHAN QUIZ --}}
            <div class="col-6 d-flex justify-content-center">

                <a href="{{ route('pengguna.quiz.index') }}"
                    class="text-decoration-none"
                    style="color:inherit;">

                    <div class="shadow-sm d-flex flex-column align-items-center justify-content-center"
                        style="
                    width: 200px;
                    height: 200px;
                    background:#fff0f6;
                    border-radius:20px;
                    border:1px solid #e8b4c9;
                    margin: 8px; 
                    transition:0.2s;
                "
                        onmouseover="this.style.transform='scale(1.07)'"
                        onmouseout="this.style.transform='scale(1)'">

                        <img src="{{ asset('icon/latihan-quiz.png') }}" width="85" class="mb-2">

                        <span style="font-weight:600; font-size:1rem; color:#4a0d2e;">
                            Latihan Quiz
                        </span>
                    </div>

                </a>
            </div>

        </div>



        @if($kategoris->count() == 0)
        <div class="col-12 text-center mt-5">
            <img src="https://img.icons8.com/fluency/96/nothing-found.png" width="90" class="mb-3">
            <p style="color:#8a6076; font-size:1rem;">
                Belum ada kategori yang tersedia
            </p>
        </div>
        @endif

    </div>
</div>
@endsection