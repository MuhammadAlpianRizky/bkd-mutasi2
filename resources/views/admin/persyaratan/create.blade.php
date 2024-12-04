@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Create Persyaratan</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('persyaratan.store') }}" method="POST">
                            @csrf
                            <!-- Nama Persyaratan -->
                            <div class="form-group">
                                <label for="nama_persyaratan">Nama Persyaratan</label>
                                <input type="text" name="nama_persyaratan" class="form-control @error('nama_persyaratan') is-invalid @enderror" id="nama_persyaratan" value="{{ old('nama_persyaratan') }}" required>
                                @error('nama_persyaratan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Kode Persyaratan -->
                            <div class="form-group">
                                <label for="kode_persyaratan">Kode Persyaratan</label>
                                <input type="text" name="kode_persyaratan" class="form-control @error('kode_persyaratan') is-invalid @enderror" id="kode_persyaratan" value="{{ old('kode_persyaratan') }}" required>
                                @error('kode_persyaratan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jenis File -->
                            <div class="form-group">
                                <label for="jenis_file">Jenis File</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_file') is-invalid @enderror" type="radio" name="jenis_file" id="pdf" value="pdf" {{ old('jenis_file') == 'pdf' ? 'checked' : '' }} checked>
                                        <label class="form-check-label" for="pdf">PDF</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input @error('jenis_file') is-invalid @enderror" type="radio" name="jenis_file" id="png" value="png" {{ old('jenis_file') == 'png' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="png">PNG</label>
                                    </div>
                                    @error('jenis_file')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Ukuran File -->
                            <div class="form-group">
                                <label for="ukuran">Ukuran (KB)</label>
                                <input type="number" name="ukuran" class="form-control @error('ukuran') is-invalid @enderror" id="ukuran" value="{{ old('ukuran') }}" required>
                                @error('ukuran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Create</button>
                            <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
