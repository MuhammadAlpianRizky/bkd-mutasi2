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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Mutasi</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-link">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Daftar Mutasi</li>
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
                        <!-- Search Form -->
                        <div class="d-flex justify-content-end mb-3">
                            <form method="GET" action="{{ route('mutasi.list') }}" class="d-flex">
                                <input type="text" name="search" class="form-control me-2" placeholder="Pencarian" value="{{ request('search') }}">
                                <select name="status">
                                    <option value="">Pilih Status</option>
                                    <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}> Proses</option>
                                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}> Draft</option>
                                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : ''}}> Diterima</option>
                                    <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}> Ditolak</option>
                                    <option value="dibatalkan" {{ request('dibatalkan') == 'dibatalkan' ? 'selected' : '' }}> Dibatalkan</option>
                                </select>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                        <!-- End Search Form -->
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead class="table">
                                    <tr>
                                        <th style="width: 5%;" class="text-center">No</th>
                                        <th style="width: 15%;">No Registrasi</th>
                                        <th style="width: 25%;">Nama</th>
                                        <th style="width: 15%;">NIP</th>
                                        <th style="width: 10%;" class="text-center">Status</th>
                                        <th style="width: 20%;" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($daftarMutasis as $index => $mutasi)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $mutasi->no_registrasi }}</td>
                                            <td>{{ $mutasi->nama }}</td>
                                            <td>{{ $mutasi->nip }}</td>
                                            <td class="text-center">
                                                @switch($mutasi->status)
                                                    @case('proses')
                                                        <span class="badge bg-info">Proses</span>
                                                        @break
                                                    @case('diterima')
                                                        <span class="badge bg-success">Diterima</span>
                                                        @break
                                                    @case('ditolak')
                                                        <span class="badge bg-danger">Ditolak</span>
                                                        @break
                                                    @case('dibatalkan')
                                                        <span class="badge bg-secondary">Dibatalkan</span>
                                                        @break
                                                    @default
                                                        <span class="badge bg-primary">Draft</span>
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group" role="group">
                                                    @if ($mutasi->is_final === 1 && !$mutasi->verified)
                                                        <a href="{{ route('mutasi.validate', $mutasi->id) }}" class="btn btn-primary btn-sm me-2">Validasi</a>
                                                    @endif
                                                    @if ($mutasi->is_final === 1 && $mutasi->verified)
                                                        <a href="{{ route('mutasi.validate', $mutasi->id) }}" class="btn btn-secondary btn-sm me-2">Edit</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="pagination float-end">
                                {!! $daftarMutasis->links() !!}
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
