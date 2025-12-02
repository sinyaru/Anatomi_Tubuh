@extends('layouts.admin')

@section('title', 'Kelola Kategori')

@section('content')

<style>
    .kategori-container {
        background-color: #fff0f6;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.08);
    }

    .btn-pink {
        background-color: #ec407a;
        color: white;
        border: none;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 600;
        transition: .2s;
    }

    .btn-pink:hover {
        background-color: #d81b60;
        color: #fff;
    }

    table th {
        background-color: #f8bbd0 !important;
        color: #4a4a4a;
        text-align: center;
        padding: 10px 8px;
        font-size: 14px;
    }

    table td {
        text-align: center;
        vertical-align: middle;
        padding: 8px 6px;
        font-size: 14px;
    }

    tbody tr:hover {
        background-color: #fde4ed;
    }

    .btn-icon {
        border: none;
        padding: 6px 8px;
        border-radius: 6px;
        cursor: pointer;
        transition: .2s;
        margin: 0 2px;
        font-size: 13px;
    }

    .btn-edit-icon {
        background-color: #ffc107;
        color: #000;
    }

    .btn-edit-icon:hover {
        background-color: #e0a800;
        transform: scale(1.1);
    }

    .btn-delete-icon {
        background-color: #dc3545;
        color: white;
    }

    .btn-delete-icon:hover {
        background-color: #c82333;
        transform: scale(1.1);
    }
</style>

<div class="kategori-container">

    <a href="{{ route('kategori.create') }}" class="btn btn-pink mb-3">
        + Tambah Kategori Baru
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="60px">#</th>
                <th>Nama Kategori</th>
                <th width="120px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($data as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td style="font-weight: 600;">{{ $item->nama }}</td>

                <td>
                    <a href="{{ route('kategori.edit', $item->id) }}"
                        class="btn-icon btn-edit-icon"
                        title="Edit">

                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="button"
                        class="btn-icon btn-delete-icon"
                        onclick="confirmDelete('{{ $item->id }}')"
                        title="Hapus">

                        <i class="fas fa-trash"></i>
                    </button>

                    <form id="delete-form-{{ $item->id }}"
                        action="{{ route('kategori.destroy', $item->id) }}"
                        method="POST"
                        style="display:none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted">
                    Belum ada kategori.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Font Awesome -->
<link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
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
</script>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
</script>
@endif



@endsection