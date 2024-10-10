@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Pending Users</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-link">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Pending Users</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <!-- Optionally, add a filter or search here if needed -->
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('cms.users') }}" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Pencarian" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        @if(session('success'))
                        <script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: '{{ session('success') }}'
                            });
                            </script>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>NIP</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th> <!-- Centered header -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUsers as $user)
                                        <tr>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center"> <!-- Centered content -->
                                                <!-- Tombol Detail -->
                                                <a href="{{ route('cms.user.detail', $user->id) }}" class="btn btn-secondary">Detail</a>

                                                <!-- Tombol Approve -->
                                                <form action="{{ route('cms.approve', $user) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Approve</button>
                                                </form>

                                                <!-- Tombol Delete dengan konfirmasi SweetAlert -->
                                                <form action="{{ route('cms.delete.user', $user) }}" method="POST" style="display:inline;" id="deleteForm{{ $user->id }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $user->id }})">Hapus</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-end">
                                {{ $pendingUsers->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

@endsection

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmDelete(userId) {
    Swal.fire({
        title: 'Yakin Menghapus User ini?',
        text: "Ini akan menghilangkan Akunnya",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit the form to delete the user
            document.getElementById('deleteForm' + userId).submit();
        }
    });
}
</script>
