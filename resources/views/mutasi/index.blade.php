@extends('users.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <h2 class="mb-4">Riwayat Mutasi</h2>

        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Alert jika ada pesan error -->
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Tombol Tambah Mutasi -->
        <div class="mb-4">
            <a href="{{ route('mutasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mutasi
            </a>
        </div>

        <!-- Tabel Riwayat Mutasi -->
        <div class="card shadow-sm">
            <div class="card-body">
                <!-- Tambahkan kelas table-responsive untuk tabel yang lebih responsif -->
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Registrasi</th>
                                <th>Tanggal Diajukan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mutasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->no_registrasi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @switch($item->status)
                                            @case('draft')
                                                <span class="badge bg-secondary">Draft</span>
                                                @break
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
                                                <span class="badge bg-dark">Dibatalkan</span>
                                                @break
                                            @default
                                                <span class="badge bg-light text-dark">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('mutasi.edit', $item->id) }}"
                                        class="btn {{ $item->is_final ? 'btn-secondary' : 'btn-warning' }} btn-sm">
                                        <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@php
    $noFooter = true;
@endphp
