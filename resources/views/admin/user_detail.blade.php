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
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th width="30%">Nama</th>
                                            <td>{{ $user->nama_lengkap }}</td>
                                        </tr>
                                        <tr>
                                            <th>NIP</th>
                                            <td>{{ $user->nip }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor KTP</th>
                                            <td>{{ $user->no_ktp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor Karpeg</th>
                                            <td>{{ $user->no_karpeg }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $user->alamat_tinggal }}</td>
                                        </tr>
                                        <tr>
                                            <th>Nomor HP</th>
                                            <td>{{ $user->no_hp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Email</th>
                                            <td>{{ $user->email }}</td>
                                        </tr>
                                        <tr>
                                            <th>Foto KTP</th>
                                            <td>
                                                @if ($user->photo_ktp)
                                                    <a href="{{ route('user.photo', ['id' => $user->id, 'photoField' => 'photo_ktp', 'action' => 'view']) }}" target="_blank" class="btn btn-primary btn-sm">
                                                        Lihat Gambar
                                                    </a>
                                                @else
                                                    <p>No photo available.</p>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Foto Karpeg</th>
                                            <td>
                                                @if ($user->photo_karpeg)
                                                    <a href="{{ route('user.photo', ['id' => $user->id, 'photoField' => 'photo_karpeg', 'action' => 'view']) }}" target="_blank" class="btn btn-primary btn-sm">
                                                        Lihat Gambar
                                                    </a>
                                                @else
                                                    <p>No photo available.</p>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row" style="margin-left: 1px">
            <div class="col-md-12">
                <a href="{{ route('cms.users') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
            </div>
        </div> --}}
    </div> <!-- ============================================================== -->
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
