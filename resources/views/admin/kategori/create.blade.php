@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')

<style>
    .form-container {
        background-color: #fff0f6;
        padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-width: 650px;
        margin: auto;
    }

    label {
        font-weight: 600;
        color: #4a4a4a;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 10px 18px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-pink:hover {
        background-color: #d81b60;
        color: #fff;
    }

    .btn-secondary {
        padding: 10px 18px;
        border-radius: 8px;
    }
</style>

<div class="form-container">

    <h4 class="mb-3" style="font-weight: 700; color:#4a4a4a;">Tambah Kategori Baru</h4>
    <hr>

    <form action="{{ route('kategori.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Kategori:</label>
            <input
                type="text"
                name="nama"
                class="form-control @error('nama') is-invalid @enderror"
                placeholder="Masukkan nama kategori..."
                required>

            @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-4 gap-2">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-pink">Simpan</button>
        </div>
    </form>

</div>

@endsection