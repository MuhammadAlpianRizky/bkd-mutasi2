@extends('users.dashboard')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Riwayat Mutasi</h2>

        @if(session('status'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="status">
                {{ session('status') }}
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
                <div class="table-responsive" style="margin-bottom: 150px;">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No. Registrasi</th>
                                <th>Tanggal Diajukan</th>
                                <th>Status</th>
                                <th>Keterangan</th> <!-- New column for cancellation reason -->
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mutasi as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->no_registrasi }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                    <td>
                                        @if($item->verified)
                                            <span class="badge bg-success">Sudah Diverifikasi</span>
                                        @else
                                            <span class="badge bg-warning text-dark">Belum Diverifikasi</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->cancellation_reason)
                                            {{ $item->cancellation_reason }}
                                        @else
                                            - <!-- Display a dash or default text if there's no reason -->
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('mutasi.edit', $item->id) }}"
                                           class="btn {{ $item->is_final ? 'btn-secondary' : 'btn-warning' }} btn-sm">
                                           <i class="fas fa-pencil-alt"></i> Edit
                                        </a>
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
