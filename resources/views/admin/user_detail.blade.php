@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Detail Pengguna: {{ $user->nama_lengkap }}</h1>
    <p>NIP: {{ $user->nip }}</p>
    <p>Alamat: {{ $user->alamat_tinggal }}</p>
    <p>No HP: {{ $user->no_hp }}</p>
    <p>Email: {{ $user->email }}</p>
    <p>No KTP: {{ $user->no_ktp }}</p>
    <p>No Karpeg: {{ $user->no_karpeg }}</p>

    <h2>Foto KTP</h2>
    @if ($user->photo_ktp)
        <img src="{{ Storage::url(decrypt($user->photo_ktp)) }}" alt="Foto KTP" style="max-width: 100%;">
    @else
        <p>No photo available.</p>
    @endif

    <h2>Foto Karpeg</h2>
    @if ($user->photo_karpeg)
        <img src="{{ Storage::url(decrypt($user->photo_karpeg)) }}" alt="Foto Karpeg" style="max-width: 100%;">
    @else
        <p>No photo available.</p>
    @endif
</div>
@endsection
