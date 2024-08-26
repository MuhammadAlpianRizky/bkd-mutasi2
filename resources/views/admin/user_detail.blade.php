@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Detail Pengguna: {{ $user->nama_lengkap }}</h1>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>NIP:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->nip }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Alamat:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->alamat_tinggal }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No HP:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->no_hp }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>Email:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->email }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No KTP:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->no_ktp }}</p>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-md-4">
            <strong>No Karpeg:</strong>
        </div>
        <div class="col-md-8">
            <p>{{ $user->no_karpeg }}</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <strong>Foto KTP:</strong>
        </div>
        <div class="col-md-8">
            @if ($user->photo_ktp)
                <img src="{{ Storage::url(decrypt($user->photo_ktp)) }}" alt="Foto KTP" class="img-thumbnail" style="max-width: 300px; max-height: 200px; width: auto; height: auto;">
            @else
                <p>No photo available.</p>
            @endif
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <strong>Foto Karpeg:</strong>
        </div>
        <div class="col-md-8">
            @if ($user->photo_karpeg)
                <img src="{{ Storage::url(decrypt($user->photo_karpeg)) }}" alt="Foto Karpeg" class="img-thumbnail" style="max-width: 300px; max-height: 200px; width: auto; height: auto;">
            @else
                <p>No photo available.</p>
            @endif
        </div>
    </div>
</div>
@endsection