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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">User Aktif</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-link">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">User Aktif</li>
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
                            <form method="GET" action="{{ route('cms.active.users') }}" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Pencarian" value="{{ request('search') }}">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <th>NIP</th>
                                        <th>Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activeUsers as $user)
                                        <tr>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('cms.user.detail', $user->id) }}" class="btn btn-secondary mx-2">Detail</a>
                                                    <a href="{{ route('cms.edit.user', $user->id) }}" class="btn btn-success mx-2">Edit</a>
                                                    <form action="{{ route('cms.deactivate', $user->id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning">Non-Aktifkan</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="pagination float-end">
                                {!! $activeUsers->links() !!}
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
