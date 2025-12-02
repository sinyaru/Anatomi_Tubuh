@extends('layouts.admin')
@section('title', 'Detail Hasil Quiz')

@section('style')
<style>
    /* Card container soft pink */
    .card-soft-pink {
        background-color: #fff0f6; /* soft pink */
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }

    /* Tombol soft pink */
    .btn-soft-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-soft-pink:hover {
        background-color: #d81b60;
        color: #fff;
    }

    /* Tabel header soft pink */
    table th {
        width: 30%;
        text-align: left;
        background-color: #f8bbd0;
        color: #4a4a4a;
        font-weight: 600;
    }

    table td {
        text-align: left;
        vertical-align: middle;
    }
</style>
@endsection

@section('content')
<div class="card-soft-pink">

    <h4 class="mb-4 font-semibold text-gray-800">Detail Hasil Quiz</h4>

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td>{{ $user->nama }}</td>
        </tr>
        <tr>
            <th>Durasi</th>
            <td>{{ $user->durasi }}</td>
        </tr>
        <tr>
            <th>Skor</th>
            <td>{{ $user->skor }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>
                @if ($user->status == 'Lulus')
                    <span class="badge btn-soft-pink">Lulus</span>
                @else
                    <span class="badge btn-soft-pink">Tidak Lulus</span>
                @endif
            </td>
        </tr>
    </table>

    <a href="{{ route('hasilquiz.index') }}" class="btn btn-soft-pink mt-3">Kembali</a>

</div>
@endsection
