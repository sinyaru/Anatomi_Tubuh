@extends('layouts.admin')

@section('title', 'Hasil Quiz')

@section('content')

<style>
    .quiz-container {
        background-color: #fff0f6; /* sama seperti organ */
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

    table {
        font-size: 14px;
    }

    table th {
        background-color: #f8bbd0 !important; /* pink header sama */
        color: #4a4a4a;
        text-align: center;
        padding: 10px 8px;
        font-size: 14px;
    }

    table td {
        text-align: center;
        vertical-align: middle;
        padding: 8px 6px;
    }

    tbody tr:hover {
        background-color: #fde4ed;
    }

    .badge-status {
        background-color: #ffb6c1;
        padding: 4px 10px;
        border-radius: 8px;
        color: white;
        font-weight: 600;
        font-size: 12px;
        display: inline-block;
    }

    /* Style untuk icon button Edit dan Hapus - DIPERKECIL */
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

<div class="quiz-container">

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="50px">No</th>
                <th width="200px">Nama</th>
                <th width="150px">Durasi</th>
                <th width="80px">Skor</th>
                <th width="120px">Status</th>
                <th width="80px">Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($data as $i => $u)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $u->nama }}</td>
                <td>{{ $u->durasi }}</td>
                <td>{{ $u->skor }}</td>

                <td>
                    <span class="badge-status">
                        {{ $u->status }}
                    </span>
                </td>

                <td>
                    <a href="{{ route('hasil-quiz.edit', $u->id) }}"
                       class="btn-icon btn-edit-icon"
                       title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>

                    <button type="button" 
                            class="btn-icon btn-delete-icon"
                            onclick="confirmDelete({{ $u->id }})"
                            title="Hapus">
                        <i class="fas fa-trash"></i>
                    </button>

                    <form id="delete-form-{{ $u->id }}" 
                          action="{{ route('hasil-quiz.destroy', $u->id) }}" 
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

<script>
    // SweetAlert untuk konfirmasi hapus
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
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

    // SweetAlert untuk notifikasi sukses setelah update/delete
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 2000
        });
    @endif
</script>

@endsection