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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Mutasi</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item"><a href="#" class="text-decoration-none">Daftar Mutasi</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detail Mutasi</li>
                        </ol>
                    </nav>
                </div>
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
            <!-- Card untuk Detail Mutasi -->
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-body">
                         <!-- Tombol Download -->
                        <div class="mb-3">
                            <a href="{{ route('laporan.downloadPdf', $mutasi->id) }}" class="btn btn-danger">Download PDF</a>
                            <a href="{{ route('laporan.downloadExcel', $mutasi->id) }}" class="btn btn-success">Download Excel</a>
                            <a href="{{ route('mutasi.list') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                        <!-- Tabel Detail Mutasi -->
                        <h4>Detail Mutasi</h4>
                        <div class="table-responsive mb-4">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr><th width="30%">Nama</th><td>{{ $mutasi->nama }}</td></tr>
                                    <tr><th>NIP</th><td>{{ $mutasi->nip }}</td></tr>
                                    <tr><th>Pangkat/Gol. Ruang</th><td>{{ $mutasi->pgol }}</td></tr>
                                    <tr><th>Jabatan</th><td>{{ $mutasi->jabatan }}</td></tr>
                                    <tr><th>Unit Kerja</th><td>{{ $mutasi->unit_kerja }}</td></tr>
                                    <tr><th>Instansi</th><td>{{ $mutasi->instansi }}</td></tr>
                                    <tr><th>No HP</th><td>{{ $mutasi->no_hp }}</td></tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Tabel Persyaratan -->
                        <h4>Persyaratan Mutasi</h4>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Nama Persyaratan</th>
                                        <th>Ada</th>
                                        <th>Tidak Ada</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($persyaratan as $item)
                                    <tr>
                                        <td>{{ $item->nama_persyaratan }}</td>
                                        <td>
                                            @if($uploads->firstWhere('persyaratan_id', $item->id))
                                                <span>&#10004;</span>
                                            @else
                                                
                                            @endif
                                        </td>
                                        <td>
                                            @if(!$uploads->firstWhere('persyaratan_id', $item->id))
                                                <span>&#10004;</span>
                                            @else
                                                
                                            @endif
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
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
