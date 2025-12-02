@extends('layouts.admin')

@section('title', 'Tambah Informasi')

@section('content')

<div class="card p-4 shadow-sm">

    {{-- TAMPILKAN ERROR VALIDASI DI SINI --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('kontributor.informasi.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Judul Pengumuman</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Pengumuman / Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Tanggal Publikasi</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <button class="btn btn-soft-pink px-4">Simpan</button>
        <a href="{{ route('kontributor.informasi.index') }}" class="btn btn-secondary px-4">Kembali</a>

    </form>

</div>

@endsection
