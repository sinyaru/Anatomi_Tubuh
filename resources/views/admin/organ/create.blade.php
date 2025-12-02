@extends('layouts.admin')

@section('title', 'Tambah Organ Tubuh')

@section('content')

<style>
    .form-wrapper {
        background-color: #ffffff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);

        /* Diperbesar tapi tetap tidak ganggu style asli */
        width: 100%;
        max-width: 1000px;
    }

    .label-title {
        font-weight: 600;
        color: #ec407a;
    }

    input,
    textarea {
        border-radius: 8px !important;
        border: 1px solid #f8bbd0 !important;
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 8px;
        font-weight: 600;
    }

    .btn-pink:hover {
        background-color: #d81b60;
    }

    /* Membuat area box melebar dan tetap di tengah */
    .stretch-box {
        display: flex;
        justify-content: center;
        width: 100%;
    }
</style>

<div class="stretch-box mt-3">

    <div class="form-wrapper">

        <form action="{{ route('organ.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <label class="label-title">Judul</label>
            <input type="text" name="judul" class="form-control mb-3" required>

            <label class="label-title">Deskripsi</label>
            <textarea name="deskripsi" class="form-control mb-3" rows="4" required></textarea>

            <label for="kategori_id">Kategori</label>
            <select name="kategori_id" class="form-control" required>
                <option value="" disabled selected>-- Pilih Kategori --</option>
                @foreach ($kategori as $item)
                <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>

            <label class="label-title">Foto</label>
            <input type="file" name="foto" class="form-control mb-4" required>

            <button class="btn btn-pink">Simpan</button>
            <a href="{{ route('organ.index') }}" class="btn btn-secondary">Batal</a>

        </form>

    </div>

</div>

@endsection