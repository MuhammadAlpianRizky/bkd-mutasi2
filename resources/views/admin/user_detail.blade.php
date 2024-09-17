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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Pengguna: {{ $user->nama_lengkap }}</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cms.users') }}" class="text-muted">Daftar Pengguna</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Detail Pengguna</li>
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
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-4">Informasi Pengguna</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-id-card"></i> <strong>NIP:</strong></div>
                                    <div class="col-md-8">{{ $user->nip }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-map-marker-alt"></i> <strong>Alamat:</strong></div>
                                    <div class="col-md-8">{{ $user->alamat_tinggal }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-phone"></i> <strong>No HP:</strong></div>
                                    <div class="col-md-8">{{ $user->no_hp }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-envelope"></i> <strong>Email:</strong></div>
                                    <div class="col-md-8">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-id-card-alt"></i> <strong>No KTP:</strong></div>
                                    <div class="col-md-8">{{ $user->no_ktp }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4"><i class="fas fa-id-badge"></i> <strong>No Karpeg:</strong></div>
                                    <div class="col-md-8">{{ $user->no_karpeg }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <hr>

                        <h5 class="card-subtitle mb-3">Foto Dokumen</h5>
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Foto KTP:</strong><br>
                                    @if ($user->photo_ktp)
                                        <!-- Membuka gambar KTP di tab baru -->
                                        <a href="{{ Storage::url(Crypt::decrypt($user->photo_ktp)) }}" target="_blank">
                                            <img src="{{ Storage::url(Crypt::decrypt($user->photo_ktp)) }}" alt="Foto KTP" class="img-thumbnail rounded shadow" style="max-width: 300px; max-height: 200px; border: 2px solid #dee2e6;">
                                        </a>
                                    @else
                                        <p>No photo available.</p>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <strong>Foto Karpeg:</strong><br>
                                    @if ($user->photo_karpeg)
                                        <!-- Membuka gambar Karpeg di tab baru -->
                                        <a href="{{ Storage::url(Crypt::decrypt($user->photo_karpeg)) }}" target="_blank">
                                            <img src="{{ Storage::url(Crypt::decrypt($user->photo_karpeg)) }}" alt="Foto Karpeg" class="img-thumbnail rounded shadow" style="max-width: 300px; max-height: 200px; border: 2px solid #dee2e6;">
                                        </a>
                                    @else
                                        <p>No photo available.</p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <a href="{{ route('cms.users') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pengguna
                                </a>
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
