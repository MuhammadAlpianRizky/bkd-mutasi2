@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Validasi Mutasi</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-muted">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('mutasi.list') }}" class="text-muted">Daftar Mutasi</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Validasi Mutasi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <!-- Card untuk Detail Mutasi -->
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Data Diri</h4>
                    </div>
                    <div class="card-body">
                        <!-- Tabel untuk menampilkan detail mutasi -->
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Nama</th>
                                    <td>{{ $mutasi->nama }}</td>
                                </tr>
                                <tr>
                                    <th>NIP</th>
                                    <td>{{ $mutasi->nip }}</td>
                                </tr>
                                <tr>
                                    <th>Pangkat/Gol.Ruang</th>
                                    <td>{{ $mutasi->pgol }}</td>
                                </tr>
                                <tr>
                                    <th>Jabatan</th>
                                    <td>{{ $mutasi->jabatan }}</td>
                                </tr>
                                <tr>
                                    <th>Unit Kerja</th>
                                    <td>{{ $mutasi->unit_kerja }}</td>
                                </tr>
                                <tr>
                                    <th>Instansi</th>
                                    <td>{{ $mutasi->instansi }}</td>
                                </tr>
                                <tr>
                                    <th>No HP</th>
                                    <td>{{ $mutasi->no_hp }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Card untuk File Persyaratan -->
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">File Persyaratan</h4>
                        <!-- Tabel untuk menampilkan file persyaratan -->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama Persyaratan</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($persyaratan as $persyaratan)
                                    @php
                                        $upload = $uploads->firstWhere('persyaratan_id', $persyaratan->id);
                                    @endphp
                                    <tr>
                                        <td>{{ $persyaratan->nama_persyaratan }}</td>
                                        <td>
                                            @if ($upload)
                                                <a href="{{ route('file.show', ['id' => $mutasi->id, 'filename' => basename($upload->file_path), 'action' => 'view']) }}" target="_blank" class="btn btn-primary btn-sm">Lihat</a>
                                            @else
                                                <span>Data Belum Ada</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form untuk Validasi -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form id="validationForm" action="{{ route('mutasi.validate.update', $mutasi->id) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control">
                                    <option value="diterima" {{ old('status', $mutasi->status) === 'diterima' ? 'selected' : '' }}>Diterima</option>
                                    <option value="ditolak" {{ old('status', $mutasi->status) === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                    <option value="dibatalkan" {{ old('status', $mutasi->status) === 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                </select>
                            </div>

                                    <!-- Keterangan Text Area -->
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea id="keterangan" name="keterangan" class="form-control" rows="4">{{ old('keterangan', $mutasi->keterangan) }}</textarea>
                                    </div>

                                    <input type="hidden" name="action" value="validate">
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer for Buttons -->
                    <div class="card-footer">
                        <button type="button" id="validateBtn" class="btn btn-primary">Simpan</button>
                        <a href="{{ route('mutasi.list') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include SweetAlert Script -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.getElementById('validateBtn').addEventListener('click', function() {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pastikan Anda telah memeriksa semua file.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Simpan!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('validationForm').submit();  // Submit the form
        }
    });
});
</script>

@endsection
