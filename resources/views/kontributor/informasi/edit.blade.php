@extends('layouts.admin')

@section('title', 'Edit Informasi')

@section('content')

<h3 class="mb-4">Edit Informasi</h3>

<div class="card p-4 shadow-sm">

    {{-- Tampilkan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kontributor.informasi.update', $informasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul Pengumuman</label>
            <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Pengumuman / Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required>{{ $informasi->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Publikasi</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $informasi->tanggal }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ $informasi->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $informasi->nama }}" required>
        </div>

        <button class="btn btn-soft-pink px-4">Update</button>
        <a href="{{ route('kontributor.informasi.index') }}" class="btn btn-secondary px-4">Kembali</a>

    </form>

</div>

@endsection
