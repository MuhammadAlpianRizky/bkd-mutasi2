@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Persyaratan</h4>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('persyaratan.update', $persyaratan->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_persyaratan">Nama Persyaratan</label>
                                <input type="text" name="nama_persyaratan" class="form-control" id="nama_persyaratan" value="{{ $persyaratan->nama_persyaratan }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jenis_file">Jenis File</label>
                                <div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_file" id="pdf" value="pdf" {{ $persyaratan->jenis_file == 'pdf' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="pdf">
                                            PDF
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jenis_file" id="jpg" value="jpg" {{ $persyaratan->jenis_file == 'jpg' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="jpg">
                                            JPG
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="ukuran">Ukuran (KB)</label>
                                <input type="number" name="ukuran" class="form-control" id="ukuran" value="{{ $persyaratan->ukuran }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('persyaratan.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
