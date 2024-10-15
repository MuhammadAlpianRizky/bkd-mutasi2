@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Pengumuman</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('pengumuman.update', $pengumuman->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <!-- Judul Pengumuman -->
                            <div class="form-group">
                                <label for="judul">Judul Pengumuman</label>
                                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" id="judul" value="{{ old('judul', $pengumuman->judul) }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Deskripsi Pengumuman -->
                            <div class="form-group">
                                <label for="deskripsi">Deskripsi Pengumuman</label>
                                <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" rows="5" required>{{ old('deskripsi', $pengumuman->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="form-group">
                                <label for="tanggal">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control @error('tanggal') is-invalid @enderror" id="tanggal" value="{{ old('tanggal', $pengumuman->tanggal) }}" required>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- File Upload -->
                            <div class="form-group">
                                <label for="file">Unggah File (Opsional)</label>
                                @php
                                    // Ambil path file dari pengumuman
                                    $filePath = $pengumuman->file_path;
                                @endphp

                                @if ($filePath)
                                    {{-- Jika file sudah di-upload --}}
                                    <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                        <span>File sudah di-upload. Anda dapat <a href="{{ route('pengumuman.show', ['pengumuman' => $pengumuman->id]) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                        <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput()">Ubah File</button>
                                    </div>
                                    <!-- Kontainer input file untuk ubah file, tersembunyi secara default -->
                                    <div id="fileInputContainer" style="display: none;">
                                        <div class="input-group">
                                            <input type="file" class="form-control" id="file" name="file" aria-describedby="upload-help">
                                        </div>
                                        <small id="upload-help" class="form-text">Format file: PDF, DOCX, ukuran maksimal 2MB</small>
                                    </div>
                                @else
                                    <!-- Jika file belum di-upload -->
                                    <div class="input-group mb-3">
                                        <input type="file" name="file" class="form-control @error('file') is-invalid @enderror" id="file">
                                    </div>
                                    <small id="upload-help" class="form-text">Format file: PDF, DOCX, ukuran maksimal 2MB</small>
                                    @error('file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                                @error('file')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ route('pengumuman.index') }}" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFileInput() {
        var fileInputContainer = document.getElementById('fileInputContainer');
        fileInputContainer.style.display = (fileInputContainer.style.display === 'none' || fileInputContainer.style.display === '') ? 'block' : 'none';
    }
</script>
@endsection
