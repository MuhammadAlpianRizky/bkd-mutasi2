@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit User</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-link">Home</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Edit User</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('cms.update.user', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nama_lengkap">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" value="{{ old('nama_lengkap', $user->nama_lengkap) }}" >
                            </div>

                            <div class="form-group">
                                <label for="nip">NIP</label>
                                <input type="text" name="nip" class="form-control" value="{{ old('nip', $user->nip) }}" >
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" >
                            </div>

                            <div class="form-group">
                                <label for="no_hp">No HP</label>
                                <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $user->no_hp) }}" >
                            </div>

                            <div class="form-group">
                                <label for="alamat_tinggal">Alamat tinggal</label>
                                <input type="text" name="alamat_tinggal" class="form-control" value="{{ old('alamat_tinggal', $user->alamat_tinggal) }}" >
                            </div>

                            <div class="form-group">
                                <label for="no_ktp">No KTP</label>
                                <input type="text" name="no_ktp" class="form-control" value="{{ old('no_ktp', $user->no_ktp) }}" >
                            </div>

                            <div class="form-group">
                                <label for="no_karpeg">No Karpeg</label>
                                <input type="text" name="no_karpeg" class="form-control" value="{{ old('no_karpeg', $user->no_karpeg) }}" >
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('cms.users') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
