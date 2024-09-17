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
                                <form id="validationForm" action="{{ route('mutasi.validate.update', $mutasi->id) }}" method="POST">
                                    <input type="hidden" name="action" value="validate">
                                    @csrf
                                    @foreach(['sk_cpns', 'sk_pns', 'sk_pangkat_terakhir', 'sk_jabatan_struktural', 'sk_jabatan_fungsional'] as $fileField)
                                        @if($mutasi->$fileField)
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="{{ $fileField }}_check" name="{{ $fileField }}_check" value="true">
                                                <label class="form-check-label" for="{{ $fileField }}_check">
                                                    {{ ucfirst(str_replace('_', ' ', $fileField)) }}: 
                                                    <a href="{{ Storage::url($mutasi->$fileField) }}" target="_blank">
                                                        View {{ ucfirst(str_replace('_', ' ', $fileField)) }}
                                                    </a>
                                                </label>
                                            </div>
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="button" id="validateBtn" class="btn btn-primary">Validasi</button>
                        <button type="button" data-toggle="modal" data-target="#cancelModal" class="btn btn-danger">Batal</button>
                        <a href="{{ route('mutasi.list') }}" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Cancel Modal -->
<div class="modal fade" id="cancelModal" tabindex="-1" role="dialog" aria-labelledby="cancelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cancelModalLabel">Batal Validasi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('mutasi.cancel', $mutasi->id) }}" method="POST">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="cancellation_reason">Alasan Pembatalan</label>
                        <textarea id="cancellation_reason" name="cancellation_reason" class="form-control" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-danger">Batal Validasi</button>
                </div>
            </form>
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
        confirmButtonText: 'Ya, Validasi!'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('validationForm').submit();  // Submit the form
        }
    });
});
</script>

@endsection
