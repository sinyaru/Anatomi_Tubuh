@extends('layouts.admin')

@section('title', 'Tambah Pengguna')

@section('content')

<style>
    .card-soft {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }
    .btn-pink {
        background-color: #ec407a;
        color: white;
        font-weight: 600;
        padding: 8px 18px;
        border-radius: 8px;
        border: none;
    }
    .btn-pink:hover {
        background-color: #d81b60;
    }
</style>

<div class="card-soft">

    <h4 class="mb-3">Tambah Pengguna Baru</h4>

    <form action="{{ route('pengguna.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" class="form-control" required value="{{ old('nama') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email / Username</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>

        {{-- 🔥 PASSWORD DIPINDAHKAN DI SINI --}}
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="">-- pilih role --</option>
                <option value="Admin">Admin</option>
                <option value="Kontributor">Kontributor</option>
                <option value="Pengguna">Pengguna</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Aktif">Aktif</option>
                <option value="Nonaktif">Nonaktif</option>
            </select>
        </div>

        <button class="btn-pink">Simpan</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

@endsection
