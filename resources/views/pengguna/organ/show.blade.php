@extends('layouts.pengguna')

@section('title', 'Pilih Kategori Organ')

@section('content')
<div class="container mt-4">

    {{-- BACK --}}
    <a href="{{ url()->previous() }}"
        style="
                display:inline-block;
                background-color:#ffe6f0;
                padding:10px 16px;
                border-radius:12px;
                color:#b03060;
                font-weight:600;
                text-decoration:none;
                box-shadow:0 2px 5px rgba(0,0,0,0.1);
           ">
        ← Kembali
    </a>

    {{-- JUDUL --}}
    <h3 class="mt-3" style="font-family:'Poppins', sans-serif; font-weight:700; color:#4a0d2e;">
        {{ $organ->judul }}
    </h3>

    {{-- GAMBAR --}}
    <div class="mt-3">
        @if($organ->foto)
        <img src="{{ asset('uploads/' . $organ->foto) }}"
            class="img-fluid"
            style="border-radius:16px; max-height:350px; object-fit:cover;">
        @else
        <div class="d-flex align-items-center justify-content-center"
            style="height:220px; background-color:#ffd6e6; border-radius:16px;">
            <img src="https://img.icons8.com/fluency/96/human-organ.png" width="90">
        </div>
        @endif
    </div>

    {{-- DESKRIPSI --}}
    <div class="mt-4 p-3"
        style="background:#fff0f6; border-radius:16px; color:#6b4c5a; font-size:1rem; line-height:1.6;">
        {!! nl2br(e($organ->deskripsi)) !!}
    </div>

    {{-- INFORMASI TAMBAHAN --}}
    @if($informasi->count())
    <h5 class="mt-4" style="font-family:'Poppins'; font-weight:600; color:#4a0d2e;">
        Informasi Tambahan
    </h5>

    @foreach($informasi as $info)
    <div class="p-3 mt-2"
        style="background:#ffe6f2; border-radius:12px; color:#6b4c5a;">
        <strong>{{ $info->judul }}</strong>
        <p class="mt-1 mb-0">{!! nl2br(e($info->deskripsi)) !!}</p>
    </div>
    @endforeach
    @endif

</div>
@endsection