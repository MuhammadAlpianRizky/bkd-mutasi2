@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <h4>Preview Laporan Bulanan</h4>
        <h5>Bulan: {{ $bulan }}</h5>

        <!-- Tabel Mutasi -->
        <div class="table-responsive mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIP</th>
                        <th>Jabatan</th>
                        <th>Unit Kerja</th>
                        <th>Tanggal Mutasi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mutasi as $item)
                    <tr>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->no_registrasi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td> <!-- Format tanggal -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tombol untuk download PDF dan Excel -->
        <div class="mt-3">
            <a href="{{ route('laporan.exportPDF2', ['bulan' => $bulan]) }}" class="btn btn-danger">Download PDF</a>
            <a href="{{ route('laporan.exportExcel2', ['bulan' => $bulan]) }}" class="btn btn-success">Download Excel</a>
        </div>
    </div>
</div>
@endsection
