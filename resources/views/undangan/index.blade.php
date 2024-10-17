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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Undangan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-link">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Undangan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <a href="{{ route('undangan.create') }}" class="btn btn-primary float-end">
                    <i class="fas fa-plus"></i> Tambah Undangan
                </a>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid" style="margin-top: 20px;">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tabel Daftar Undangan -->
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Undangan</th>
                                <th>No. Registrasi</th>
                                <th>Nama</th>
                                <th>NIP</th>
                                <th>Jabatan</th>
                                <th>Unit Kerja</th>
                                <th>File PDF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($undangan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->kode_undangan }}</td>
                                    <td>{{ $item->mutasi->no_registrasi }}</td>
                                    <td>{{ $item->mutasi->nama }}</td>
                                    <td>{{ $item->mutasi->nip }}</td>
                                    <td>{{ $item->mutasi->jabatan }}</td>
                                    <td>{{ $item->mutasi->unit_kerja }}</td>
                                    <td>
                                        <a href="{{ route('undangan.show',['id' => $item->id, 'filename' => basename($item->file), 'action' => 'view']) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye"></i> Lihat
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
