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
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Detail Pengguna</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('cms.users') }}" class="text-decoration-none">Daftar Pengguna</a></li>
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

        <div class="container-fluid">
            <div class="row">
                <!-- Card untuk Detail Mutasi -->
                <div class="col-12">
                    <div class="card mb-3">
                        <div class="card-body">
                            <!-- Tabel untuk menampilkan detail mutasi -->
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th width="5%">Nama</th>
                                        <td width="30%">{{ $user->nama_lengkap }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">NIP</th>
                                        <td width="30%">{{ $user->nip }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">Nomor KTP</th>
                                        <td width="30%">{{ $user->no_ktp }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">Nomor Karpeg</th>
                                        <td width="30%">{{ $user->no_karpeg }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">Alamat</th>
                                        <td width="30%">{{ $user->alamat_tinggal }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">Nomor HP</th>
                                        <td width="30%">{{ $user->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <th width="5%">Email</th>
                                        <td width="30%">{{ $user->email }}</td>
                                    </tr>
                                </tbody>
                            </table>

                            <hr>

                            <!-- Bagian Foto Dokumen -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Foto KTP:</strong><br>
                                        @if ($user->photo_ktp)
                                            <!-- Link to view and download KTP -->
                                            <a href="{{ route('user.photo', ['id' => $user->id, 'photoField' => 'photo_ktp', 'action' => 'view']) }}" target="_blank">
                                                Lihat
                                            </a>
                                            <br>
                                        @else
                                            <p>No photo available.</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <strong>Foto Karpeg:</strong><br>
                                        @if ($user->photo_karpeg)
                                            <!-- Link to view and download Karpeg -->
                                            <a href="{{ route('user.photo', ['id' => $user->id, 'photoField' => 'photo_karpeg', 'action' => 'view']) }}" target="_blank">
                                                Lihat
                                            </a>
                                            <br>
                                        @else
                                            <p>No photo available.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


                        <div class="row" style="margin-left: 1px">
                            <div class="col-md-12">
                                <a href="{{ route('cms.users') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>        <!-- ============================================================== -->
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
