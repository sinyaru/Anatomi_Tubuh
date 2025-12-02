@extends('layouts.admin')

@section('title', 'Profil Saya')

@section('content')

<style>
    .profile-card {
        background: #fff;
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }

    .profile-card h4 {
        font-weight: 600;
        margin-bottom: 15px;
        color: #ec407a;
    }

    .form-group label {
        font-weight: 500;
    }

    .info-box {
        background: #fff0f6;
        border-left: 4px solid #ec407a;
        padding: 15px;
        border-radius: 10px;
        margin-top: 15px;
    }
</style>

<div class="row">

    {{-- NOTIFIKASI BERHASIL UPDATE --}}
    @if (session('status') === 'password-updated')
        <div class="alert alert-success" style="
            background:#d4edda;
            padding:12px 18px;
            border-left:4px solid #28a745;
            border-radius:10px;
            margin-bottom:20px;
            color:#155724;">
            Password berhasil diperbarui!
        </div>
    @endif

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success" style="
            background:#d4edda;
            padding:12px 18px;
            border-left:4px solid #28a745;
            border-radius:10px;
            margin-bottom:20px;
            color:#155724;">
            Profil berhasil diperbarui!
        </div>
    @endif


    {{-- CARD INFO PROFIL --}}
    <div class="col-lg-12">
        <div class="profile-card">
            <h4>Informasi Profil</h4>

            <div class="row">

                {{-- Nama --}}
                <div class="col-lg-4 mb-3">
                    <label>Nama:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->name }}" readonly>
                </div>

                {{-- Email --}}
                <div class="col-lg-4 mb-3">
                    <label>Email:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>

                {{-- Role --}}
                <div class="col-lg-4 mb-3">
                    <label>Role:</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->role }}" readonly>
                </div>

            </div>
        </div>
    </div>

    {{-- CARD UBAH PASSWORD --}}
    <div class="col-lg-6">
        <div class="profile-card">
            <h4>Ubah Password</h4>

            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Password Sekarang</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Password Baru</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Konfirmasi Password Baru</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <button class="btn btn-soft-pink px-4">Update Password</button>
            </form>
        </div>
    </div>

    {{-- PEMBERITAHUAN --}}
    <div class="col-lg-6">
        <div class="info-box">
            <h5>Informasi</h5>
            <p>
                Pastikan password baru mudah diingat namun tetap aman.
                Jika lupa password silakan hubungi admin.
            </p>
        </div>
    </div>

</div>

@endsection
