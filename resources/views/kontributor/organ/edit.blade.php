@extends('layouts.admin')

@section('title', 'Edit Organ Tubuh')

@section('content')
<div class="container">

    <form action="{{ route('kontributor.organ.update', $data->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $data->judul }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5">{{ $data->deskripsi }}</textarea>
        </div>

        <label for="kategori_id">Kategori</label>
        <select name="kategori_id" class="form-control" required>
            @foreach ($kategori as $item)
            <option value="{{ $item->id }}"
                {{ $data->kategori_id == $item->id ? 'selected' : '' }}>
                {{ $item->nama }}
            </option>
            @endforeach
        </select>

        <div class="mb-3">
            <label>Foto Lama</label><br>
            <img src="{{ asset('uploads/' . $data->foto) }}" width="150">
        </div>

        <div class="mb-3">
            <label>Ganti Foto (opsional)</label>
            <input type="file" name="foto" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
    </form>
</div>
@endsection