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
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
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
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>NIP</th>
                                        <th>Nama Lengkap</th>
                                        <th>Email</th>
                                        <th class="text-center">Action</th> <!-- Centered header -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pendingUsers as $user)
                                        <tr>
                                            <td>{{ $user->nip }}</td>
                                            <td>{{ $user->nama_lengkap }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-center"> <!-- Centered content -->
                                                <a href="{{ route('cms.user.detail', $user->id) }}" class="btn btn-secondary">Detail</a>
                                                <form action="{{ route('cms.approve', $user) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Approve</button>
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
