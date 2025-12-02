@extends('layouts.pengguna')

@section('title', 'Profil Saya')

@section('content')
<div class="container-fluid">

    <h3 class="mb-4" style="color: #4a0d2e; font-weight: 600;">Profil Saya</h3>

    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row g-4">

        {{-- Informasi Profil --}}
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title mb-4" style="color: #ec407a; font-weight: 600;">Informasi Profil</h4>

                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nama:</label>
                            <input type="text" class="form-control" value="{{ $user->name }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Email:</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Role:</label>
                            <input type="text" class="form-control" value="{{ ucfirst($user->role) }}" disabled>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Form Ubah Password --}}
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title mb-4" style="color: #ec407a; font-weight: 600;">Ubah Password</h4>

                    <form action="{{ route('pengguna.profil.update-password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <input type="password" name="current_password" class="form-control" placeholder="Password Sekarang" required>
                            @error('current_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <input type="password" name="new_password" class="form-control" placeholder="Password Baru" required>
                            @error('new_password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <input type="password" name="new_password_confirmation" class="form-control" placeholder="Konfirmasi Password Baru" required>
                        </div>

                        <button type="submit" class="btn px-4" style="background-color: #ec407a; color: white;">
                            Update Password
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Informasi Tambahan --}}
        <div class="col-lg-4">
            <div class="card shadow-sm" style="background-color: #ffd6e6; border: 1px solid #f8bbd0;">
                <div class="card-body">
                    <h5 class="card-title" style="color: #4a0d2e; font-weight: 600;">Informasi</h5>
                    <p class="card-text text-muted">
                        Pastikan password baru mudah diingat namun tetap aman. Jika lupa password silakan hubungi admin.
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
    .form-control:disabled,
    .form-control[readonly] {
        background-color: #fffafc;
        border: 1px solid #f0e0e8;
        color: #4a0d2e;
        opacity: 1;
    }
</style>
@endsection
