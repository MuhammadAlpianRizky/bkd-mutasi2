@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">User Non-Aktif</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">User Non-Aktif</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('cms.inactive.users') }}" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Pencarian" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered no-wrap">
                                @if(session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            @if(session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>NIP</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inactiveUsers as $user)
                                        <tr>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                    <div class="btn-group" role="group" style="margin-bottom: 1cm;">
                                                        <a href="{{ route('cms.user.detail', $user->id) }}" class="btn btn-secondary mx-2">Detail</a>
                                                        <form action="{{ route('cms.activate', $user->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            <button type="submit" class="btn btn-success mx-2">Aktifkan</button>
                                                        </form>
                                                        <form action="{{ route('cms.delete.user2', $user->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger delete-btn">Hapus</button>
                                                        </form>
                                                    </div>
                                                </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination float-end">
                                {!! $inactiveUsers->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
   // Select all delete buttons
const deleteButtons = document.querySelectorAll('.delete-btn');

deleteButtons.forEach(function(button) {
    button.addEventListener('click', function() {
        // Find the closest form element
        const form = button.closest('form');

        // Show the SweetAlert confirmation dialog
        Swal.fire({
            title: 'Apakah Yakin Menghapus Akun?',
            text: "Akun tidak bisa dikembalikan",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus',
            cancelButtonText: 'Batal'
        }).then((result) => {
            // If the user confirms the deletion
            if (result.isConfirmed) {
                form.submit(); // Submit the form
            }
        });
    });
});

</script>
@endsection
