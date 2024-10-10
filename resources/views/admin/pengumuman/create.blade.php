@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Tambah Pengumuman</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengumuman.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!-- Judul Pengumuman -->
                            <div class="form-group">
                                <label for="judul">Judul Pengumuman</label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" value="{{ old('judul') }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi Pengumuman -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Pengumuman</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="file">Unggah File</label>
                                <div class="input-group">
                                    <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file" required>
                                    <span class="input-group-append">
                                        <a id="view-file" href="#" target="_blank" class="btn btn-outline-info d-none">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </span>
                                </div>
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('pengumumans/js/pengumuman.js') }}"></script>

@endsection
