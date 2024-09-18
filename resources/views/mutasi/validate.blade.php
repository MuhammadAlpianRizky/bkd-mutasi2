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
            <div class="col-5 align-self-center">
                <!-- Optionally, add a filter or search here if needed -->
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Detail Mutasi</h2>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Nama:</strong> {{ $mutasi->nama }}</p>
                                <p><strong>NIP:</strong> {{ $mutasi->nip }}</p>
                                <p><strong>Unit Kerja:</strong> {{ $mutasi->unit_kerja }}</p>
                                <p><strong>Instansi:</strong> {{ $mutasi->instansi }}</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Files:</strong></p>
                                @foreach($persyaratan as $persyaratan)
                                    @php
                                        $upload = $uploads->firstWhere('persyaratan_id', $persyaratan->id);
                                    @endphp
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            {{ $persyaratan->nama_persyaratan }}:
                                            @if ($upload)
                                                <a href="{{ route('file.show', ['id' => $mutasi->id, 'filename' => basename($upload->file_path), 'action' => 'view']) }}" target="_blank">
                                                    Lihat
                                                </a>
                                            @else
                                                <span>Data Belum Ada</span>
                                            @endif
                                        </label>
                                    </div>
                                @endforeach
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
                                    <input type="hidden" name="action" value="validate">
                                </form>
                            </div>
                        </div>
                    </div>
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
