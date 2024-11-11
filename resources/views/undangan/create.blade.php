@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid" style="margin-top: 20px;">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        <form action="{{ route('undangan.store') }}" method="POST" enctype="multipart/form-data" id="undanganForm">
            @csrf

            <!-- Filter Bulan -->
            <div class="mb-4">
                <label for="monthSelect" class="form-label font-weight-bold">Pilih Bulan</label>
                <input type="month" id="monthSelect" class="form-control" value="{{ request('selected_month') }}" onchange="filterMutasi()">
            </div>

            <!-- Daftar Mutasi dalam Tabel -->
            <h5 class="mt-5 mb-4 text-center">Pilih Pegawai untuk Diundang</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="selectAll" onclick="toggleSelectAll()"></th>
                            <th>Nama</th>
                            <th>NIP</th>
                            <th>No Registrasi</th>
                        </tr>
                    </thead>
                    <tbody id="mutasiList">
                        @forelse($mutasi as $item)
                            <tr>
                                <td><input type="checkbox" name="mutasi_ids[]" value="{{ $item->id }}" class="mutasiCheckbox"></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->nip }}</td>
                                <td>{{ $item->no_registrasi }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center">Tidak ada pegawai untuk bulan ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Tombol Simpan yang Muncul Jika Ada Pegawai yang Dipilih -->
            <div id="saveButtonContainer" style="display: none;">
                <button type="button" class="btn btn-success btn-block" onclick="showFileUploadForm()">Simpan & Kirim Undangan</button>
            </div>

            <!-- Form Upload File yang Muncul Setelah Menekan Simpan -->
            <div id="fileUploadForm" style="display: none;" class="mt-4">
                <div class="mb-3">
                    <label for="file" class="form-label font-weight-bold">Upload Undangan (PDF)</label>
                    <input type="file" class="form-control" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Kirim Undangan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Fungsi untuk filter berdasarkan bulan
    function filterMutasi() {
        var selectedMonth = document.getElementById('monthSelect').value;

        // Redirect ke halaman yang sama dengan parameter bulan yang dipilih
        if (selectedMonth) {
            window.location.href = `/cms/undangan/create?selected_month=${selectedMonth}`;
        } else {
            // Reload tanpa filter jika bulan tidak dipilih
            window.location.href = `/cms/undangan/create`;
        }
    }

    // Fungsi untuk toggle checkbox "Pilih Semua"
    function toggleSelectAll() {
        var selectAllCheckbox = document.getElementById('selectAll');
        var mutasiCheckboxes = document.querySelectorAll('.mutasiCheckbox');
        
        mutasiCheckboxes.forEach(function(checkbox) {
            checkbox.checked = selectAllCheckbox.checked;
        });
        toggleSaveButton();
    }

    // Fungsi untuk menampilkan tombol simpan jika ada pegawai yang dipilih
    function toggleSaveButton() {
        var selectedCheckboxes = document.querySelectorAll('.mutasiCheckbox:checked');
        var saveButtonContainer = document.getElementById('saveButtonContainer');
        
        if (selectedCheckboxes.length > 0) {
            saveButtonContainer.style.display = 'block';
        } else {
            saveButtonContainer.style.display = 'none';
        }
    }

    // Fungsi untuk menampilkan form upload file setelah tombol simpan diklik
    function showFileUploadForm() {
        var fileUploadForm = document.getElementById('fileUploadForm');
        fileUploadForm.style.display = 'block';
    }

    // Memantau perubahan checkbox untuk menampilkan tombol simpan
    var checkboxes = document.querySelectorAll('.mutasiCheckbox');
    checkboxes.forEach(function(checkbox) {
        checkbox.addEventListener('change', toggleSaveButton);
    });
</script>
@endsection
