@extends('layouts.admin')

@section('title', 'Edit Pengguna')

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

    <h4 class="mb-3">Edit Pengguna</h4>

    <form action="{{ route('pengguna.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" required value="{{ $user->nama }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Email / Username</label>
            <input type="email" name="email" class="form-control" required value="{{ $user->email }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-control" required>
                <option value="Admin" {{ $user->role == 'Admin' ? 'selected' : '' }}>Admin</option>
                <option value="Kontributor" {{ $user->role == 'Kontributor' ? 'selected' : '' }}>Kontributor</option>
                <option value="Pengguna" {{ $user->role == 'Pengguna' ? 'selected' : '' }}>Pengguna</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-control" required>
                <option value="Aktif" {{ $user->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                <option value="Nonaktif" {{ $user->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
            </select>
        </div>

        <button class="btn-pink">Perbarui</button>
        <a href="{{ route('pengguna.index') }}" class="btn btn-secondary">Kembali</a>

    </form>

</div>

@endsection
