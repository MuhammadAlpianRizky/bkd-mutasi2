@extends('layouts.app')

@section('content')

<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
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
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h2>Detail Mutasi</h2>
                        <p><strong>Nama:</strong> {{ $mutasi->nama }}</p>
                        <p><strong>NIP:</strong> {{ $mutasi->nip }}</p>
                        <p><strong>Unit Kerja:</strong> {{ $mutasi->unit_kerja }}</p>
                        <p><strong>Instansi:</strong> {{ $mutasi->instansi }}</p>
                        <p><strong>Files:</strong></p>
                        @foreach(['sk_cpns', 'sk_pns', 'sk_pangkat_terakhir', 'sk_jabatan_struktural', 'sk_jabatan_fungsional'] as $fileField)
                            @if($mutasi->$fileField)
                                <p><a href="{{ route('file.show', ['id' => $mutasi->id, 'fileField' => $fileField]) }}" data-toggle="modal" data-target="#fileModal" class="file-link">{{ ucfirst(str_replace('_', ' ', $fileField)) }}</a></p>
                            @endif
                        @endforeach
                    </div>
                    <div class="card-footer">
                        <form action="{{ route('mutasi.validate.update', $mutasi->id) }}" method="POST">
                            @csrf
                            <button type="submit" name="action" value="validate" class="btn btn-primary">Validasi</button>
                            <a href="{{ route('mutasi.list') }}" class="btn btn-secondary">Kembali</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Page Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->

<!-- Modal -->
<div class="modal fade" id="fileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="fileModalLabel">File Preview</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="filePreview" style="width: 100%; height: 500px;" frameborder="0"></iframe>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const fileLinks = document.querySelectorAll('.file-link');
    
    fileLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            const fileUrl = this.getAttribute('href');
            const fileName = this.textContent;
            
            // Update modal content
            document.getElementById('fileModalLabel').textContent = `Preview of ${fileName}`;
            document.getElementById('filePreview').src = fileUrl;
            
            // Show the modal
            $('#fileModal').modal('show');
        });
    });
});
</script>
@endsection
