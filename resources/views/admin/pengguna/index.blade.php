@extends('layouts.admin')

@section('title', 'Daftar Pengguna')

@section('content')

<style>
    /* Container kartu */
    .card-soft-pink {
        background-color: #fff0f6;
        /* putih / pink lembut */
        border-radius: 12px;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.15);
    }

    /* Tombol soft pink */
    .btn-soft-pink {
        background-color: #ec407a;
        color: white;
        padding: 8px 18px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        display: inline-block;
        margin-bottom: 0 !important;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-soft-pink:hover {
        background-color: #d81b60;
        color: white;
    }

    /* Tabel header soft pink seperti Quiz */
    table thead th {
        background-color: #f8bbd0;
        /* header pink lembut */
        color: #4a4a4a;
        /* teks gelap */
        font-weight: 600;
        text-align: center;
        border-bottom: 2px solid #d81b60;
        /* memberi efek kotak mirip Quiz */
        padding: 10px;
    }

    /* Hover row soft pink */
    tbody tr:hover {
        background-color: #fde4ed;
    }

    /* Tabel sel tetap rata tengah */
    table td {
        text-align: center;
        vertical-align: middle;
    }

    /* Style untuk icon button Edit dan Hapus */
    .btn-icon {
        border: none;
        padding: 5px 7px;
        border-radius: 4px;
        cursor: pointer;
        transition: .2s;
        margin: 0 2px;
        font-size: 12px;
    }

    .btn-edit-icon {
        background-color: #ffc107;
        color: #000;
    }

    .btn-edit-icon:hover {
        background-color: #e0a800;
        transform: scale(1.15);
    }

    .btn-delete-icon {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete-icon:hover {
        background-color: #c82333;
        transform: scale(1.15);
    }
</style>

{{-- Tombol tambah pengguna --}}
<a href="{{ route('pengguna.create') }}" class="btn-soft-pink mb-3">+ Tambahkan Pengguna Baru</a>

<div class="card-soft-pink mt-2">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th width="200px">Nama</th>
                <th width="250px">Email / Username</th>
                <th width="120px">Role</th>
                <th width="100px">Status</th>
                <th width="80px">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $i => $user)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>{{ $user->status }}</td>
                <td>
                    <a href="{{ route('pengguna.edit', $user->id) }}"
                        class="btn-icon btn-edit-icon"
                        title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="button"
                        class="btn-icon btn-delete-icon"
                        onclick="confirmDelete('{{ $user->id }}')"
                        title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>

                    <form id="delete-form-{{ $user->id }}"
                        action="{{ route('pengguna.destroy', $user->id) }}"
                        method="POST"
                        style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome untuk icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

@if(session('success'))
<script>
    // SweetAlert untuk konfirmasi hapus
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data pengguna yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // SweetAlert untuk notifikasi sukses
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 2000
    });
</script>
@endif

@endsection