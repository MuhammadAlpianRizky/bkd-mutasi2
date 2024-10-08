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

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <a href="{{ route('mutasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Mutasi
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped align-middle">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 5%;" class="text-center">No</th>
                                <th style="width: 15%;" class="text-center">No. Registrasi</th>
                                <th style="width: 10%;" class="text-center">Status</th>
                                <th style="width: 40%;">Keterangan</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mutasi as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $item->no_registrasi }}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case('draft')
                                                <span class="badge bg-secondary rounded-pill">Draft</span>
                                                @break
                                            @case('proses')
                                                <span class="badge bg-info rounded-pill">Proses</span>
                                                @break
                                            @case('diterima')
                                                <span class="badge bg-success rounded-pill">Diterima</span>
                                                @break
                                            @case('ditolak')
                                                <span class="badge bg-danger rounded-pill">Ditolak</span>
                                                @break
                                            @case('dibatalkan')
                                                <span class="badge bg-dark rounded-pill">Dibatalkan</span>
                                                @break
                                            @default
                                                <span class="badge bg-light text-dark rounded-pill">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $item->keterangan }}</td>                                                                                                                                                                            
                                    <td class="text-center">
                                        <a href="{{ route('mutasi.edit', $item->id) }}"
                                        class="btn {{ $item->is_final ? 'btn-secondary' : 'btn-warning' }} btn-sm mb-2 align-items-center justify-content-center">
                                            <i class="fas fa-pencil-alt me-1"></i> Edit
                                        </a>
                                        <br>
                                        @if($item->undangan && $item->undangan->file)
                                            
                                            <!-- Tombol untuk melihat file -->
                                            <a href="{{ route('mutasi.show1', ['mutasi' => $item->id, 'action' => 'view']) }}?filename={{ basename($item->undangan->file) }}" target="_blank" class="btn btn-sm btn-info mb-2">
                                                <i class="fas fa-eye"></i> Undangan
                                            </a>
                                            
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
@endsection

@php
    $noFooter = true;
@endphp
