@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <h4>Laporan Bulanan</h4>

        <!-- Form Filter Bulan -->
        <form action="{{ route('laporan.bulanan') }}" method="GET">
            <div class="form-group">
                <label for="bulan">Pilih Bulan:</label>
                <input type="month" name="bulan" id="bulan" value="{{ $bulan }}" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
            <a href="{{ route('laporan.preview2', ['bulan' => $bulan]) }}" class="btn btn-secondary">Preview Laporan</a>
        </form>

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
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->unit_kerja }}</td>
                        <td>{{ $item->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
