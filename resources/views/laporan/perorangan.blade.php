@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <h4>Laporan Perorangan</h4>
        
        <!-- Form Pilih Mutasi -->
        <form action="{{ route('laporan.perorangan') }}" method="GET">
            <div class="form-group">
                <label for="mutasi_id">Pilih Mutasi:</label>
                <select name="mutasi_id" id="mutasi_id" class="form-control">
                    @foreach ($mutasiList as $m)
                    <option value="{{ $m->id }}"
                        {{ (isset($selectedMutasiId) && $selectedMutasiId == $m->id) ? 'selected' : '' }}>
                        {{ $m->nama }} - {{ $m->nip }}
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Lihat Detail</button>
        </form>

        <!-- Tampilkan Detail Jika Mutasi Dipilih -->
        @if(isset($mutasi))
        <div class="mt-4">
            <h4>Detail Mutasi</h4>
            <table class="table table-bordered">
                <tr><th>Nama</th><td>{{ $mutasi->nama }}</td></tr>
                <tr><th>NIP</th><td>{{ $mutasi->nip }}</td></tr>
                <tr><th>Jabatan</th><td>{{ $mutasi->jabatan }}</td></tr>
                <tr><th>Unit Kerja</th><td>{{ $mutasi->unit_kerja }}</td></tr>
                <tr><th>Instansi</th><td>{{ $mutasi->instansi }}</td></tr>
                <tr><th>No HP</th><td>{{ $mutasi->no_hp }}</td></tr>
            </table>
            <!-- Tambahkan tombol untuk preview laporan -->
            <a href="{{ route('laporan.preview', $mutasi->id) }}" class="btn btn-secondary">Preview Laporan</a>
        </div>
        @else
            <div class="alert alert-warning">Silakan pilih mutasi untuk melihat detail.</div>
        @endif
    </div>
</div>
@endsection
