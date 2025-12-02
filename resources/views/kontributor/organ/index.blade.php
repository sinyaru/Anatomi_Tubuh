@extends('layouts.admin')

@section('title', 'Kelola Organ Tubuh')

@section('content')

<style>
    .organ-container {
        background-color: #fff0f6;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
    }

    table td {
        text-align: center;
        vertical-align: middle;
        padding: 8px 6px;
    }

    table td img {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 6px;
    }

    tbody tr:hover {
        background-color: #fde4ed;
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

<div class="organ-container">

    <a href="{{ route('kontributor.organ.create') }}" class="btn btn-pink mb-3">
        + Tambahkan Organ Baru
    </a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="100px">Foto</th>
                <th width="150px">Judul</th>
                <th>Deskripsi</th>
                <th>Kategori</th>
                <th width="80px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $item)
            <tr>
                <td><img src="{{ asset('uploads/'.$item->foto) }}"></td>
                <td>{{ $item->judul }}</td>
                <td style="text-align: left;">{{ Str::limit($item->deskripsi, 60) }}</td>
                <td>{{ $item->kategori->nama ?? '-' }}</td>
                <td>
                    <a href="{{ route('kontributor.organ.edit',$item->id) }}"
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
                        action="{{ route('kontributor.organ.destroy', $item->id) }}"
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
            text: "Data organ yang dihapus tidak dapat dikembalikan!",
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