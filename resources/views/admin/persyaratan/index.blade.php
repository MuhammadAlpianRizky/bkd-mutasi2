@extends('layouts.app')

@section('content')


<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Persyaratan</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Persyaratan</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center text-right">
                <a href="{{ route('persyaratan.create') }}" class="btn btn-primary mx-2"><i class="bi bi-plus-circle px-1"></i>Tambah Persyaratan</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr class="text-center">
                                        <th>No.</th>
                                        <th class="table-nowrap">Nama Persyaratan</th>
                                        <th>Kode Persyaratan</th>
                                        <th>Jenis File</th>
                                        <th>Ukuran (KB)</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($persyaratan as $index => $item)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 + ($persyaratan->currentPage() - 1) * $persyaratan->perPage() }}</td>
                                            <td style="max-width: 100px; word-wrap: break-word;">{{ $item->nama_persyaratan }}</td>
                                            <td>{{ $item->kode_persyaratan }}</td>
                                            <td class="text-center">{{ $item->jenis_file }}</td>
                                            <td class="text-center">{{ $item->ukuran }}</td>
                                            <!-- Status Column -->
                                            <td class="text-center">
                                                @if ($item->status == 1)
                                                    <span class="badge badge-success">Aktif</span>
                                                @else
                                                    <span class="badge badge-danger">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('persyaratan.edit', $item->id) }}" class="btn mx-2" style="background-color: #777777; color: white">
                                                    <i class="bi bi-pencil-square px-1"></i>Edit
                                                </a>

                                                <form id="delete-form-{{ $item->id }}" action="{{ route('persyaratan.destroy', $item->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn btn-danger me-2 delete-btn" data-id="{{ $item->id }}">
                                                        <i class="bi bi-trash3 px-1"></i>Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Pagination Links -->
                            <div class="pagination float-end">
                                {!! $persyaratan->links() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js-mutasi/admin.js') }}"></script>
@endsection
