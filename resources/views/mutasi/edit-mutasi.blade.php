@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="{{ route('mutasi.update', $mutasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Card untuk Data Pribadi (Step 1) -->
                        <div id="step-1" class="card shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Form Pengajuan Mutasi - Data Diri</h4>
                            </div>
                            <div class="card-body">
                                <!-- Nama -->
                                <div class="mb-4 row">
                                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $mutasi->nama) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('nama')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- NIP -->
                                <div class="mb-4 row">
                                    <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="nip" name="nip" value="{{ old('nip', $mutasi->nip) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('nip')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Pangkat/Gol. Ruang -->
                                <div class="mb-4 row">
                                    <label for="pgol" class="col-sm-4 col-form-label">Pangkat/Gol. Ruang</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pgol" name="pgol" value="{{ old('pgol', $mutasi->pgol) }}">
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('pgol')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Jabatan -->
                                <div class="mb-4 row">
                                    <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" value="{{ old('jabatan', $mutasi->jabatan) }}">
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('jabatan')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Unit Kerja -->
                                <div class="mb-4 row">
                                    <label for="unit_kerja" class="col-sm-4 col-form-label">Unit Kerja</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="{{ old('unit_kerja', $mutasi->unit_kerja) }}">
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('unit_kerja')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Instansi -->
                                <div class="mb-4 row">
                                    <label for="instansi" class="col-sm-4 col-form-label">Instansi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi', $mutasi->instansi) }}">
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('instansi')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- No. HP -->
                                <div class="mb-4 row">
                                    <label for="no_hp" class="col-sm-4 col-form-label">No. HP</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $mutasi->no_hp) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                        @error('no_hp')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Button untuk Lanjut ke Step 2 -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-dark" id="saveSubmitBtn" data-bs-toggle="modal" data-bs-target="#saveModal">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-primary" id="next-btn" onclick="nextStep()">
                                        <i class="fas fa-arrow-right"></i> Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card untuk Upload File (Step 2) -->
                        <div id="step-2" class="card d-none shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Form Pengajuan Mutasi - Upload Dokumen</h4>
                            </div>
                            <div class="card-body">
                                <div class="mb-4">
                                    <label for="sk_cpns" class="form-label">Copy + legalisir SK CPNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf" onchange="showFileLink('sk_cpns', 'view-sk_cpns')">
                                        @if ($mutasi->sk_cpns)
                                                <span class="input-group-text">
                                                    <a href="{{ Storage::url($mutasi->sk_cpns) }}" target="_blank" class="btn btn-link">Lihat SK CPNS</a>
                                                </span>
                                        @endif
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>
                                    <div class="mt-2">
                                        <a id="view-sk_cpns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                            <i class="fas fa-eye"></i> Lihat File SK CPNS
                                        </a>
                                    </div>
                                    @if ($errors->has('sk_cpns'))
                                        <div class="text-danger">{{ $errors->first('sk_cpns') }}</div>
                                    @endif
                                </div>

                                <div class="mb-4">
                                    <label for="sk_pns" class="form-label">Copy + legalisir SK CPNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf" onchange="showFileLink('sk_pns', 'view-sk_pns')">
                                        @if ($mutasi->sk_pns)
                                                <span class="input-group-text">
                                                    <a href="{{ Storage::url($mutasi->sk_pns) }}" target="_blank" class="btn btn-link">Lihat SK PNS</a>
                                                </span>
                                        @endif
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>
                                    <div class="mt-2">
                                        <a id="view-sk_pns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                            <i class="fas fa-eye"></i> Lihat File SK PNS
                                        </a>
                                    </div>
                                    @if ($errors->has('sk_pns'))
                                        <div class="text-danger">{{ $errors->first('sk_pns') }}</div>
                                    @endif
                                </div>

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" id="prev-btn" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-dark" id="saveSubmitBtn" data-bs-toggle="modal" data-bs-target="#saveModal">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                <!-- Finish Button -->
                                    <button type="button" name="action" value="finish" id="finish-btn" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#finishModal">
                                        <i class="fas fa-check"></i> Finish
                                    </button>

                                        <!-- Finish Modal -->
                                        <div class="modal fade" id="finishModal" tabindex="-1" aria-labelledby="finishModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="finishModalLabel">Finish</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah Anda yakin ingin menyelesaikan pengisian data mutasi?
                                                    </div>
                                    <div class="modal-footer">
                                        <form id="finish-form" action="{{ route('mutasi.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="action" value="finish">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Finish</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </main>

    <!-- Save Modal -->
    @include('partials.modal', [
        'id' => 'saveModal',
        'title' => 'Konfirmasi Simpan',
        'slot' => 'Data Anda Tersimpan Sementara dan Bisa Mengedit Nanti',
        'saveButtonText' => 'Ya, Simpan'
    ])

    <script>
   document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk mengirimkan formulir
    function submitForm(action) {
        const form = document.getElementById('mutasiForm');
        if (form) {
            // Tambahkan input tersembunyi untuk menyimpan aksi yang dipilih
            const actionInput = document.createElement('input');
            actionInput.type = 'hidden';
            actionInput.name = 'action';
            actionInput.value = action;
            form.appendChild(actionInput);
            form.submit();
        }
    }

    // Fungsi untuk menambahkan event listener ke tombol modal
    function setupModal(id, action) {
        const modal = document.getElementById(id);
        if (!modal) return;

        const submitBtn = document.getElementById(`${id}-action`);
        if (submitBtn) {
            submitBtn.addEventListener('click', function () {
                submitForm(action);
            });
        }
    }

    // Setup event listeners untuk modals
    setupModal('saveModal', 'save');
});




        function showFileLink(inputId, linkId) {
            var input = document.getElementById(inputId);
            var link = document.getElementById(linkId);

            if (link.href) {
                URL.revokeObjectURL(link.href);
            }

            if (input.files && input.files[0]) {
                var file = input.files[0];
                if (file.type === 'application/pdf') {
                    var objectURL = URL.createObjectURL(file);
                    link.href = objectURL;
                    link.classList.remove('d-none');
                } else {
                    link.classList.add('d-none');
                }
            }
        }

        function nextStep() {
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');
            document.getElementById('prev-btn').disabled = false;
        }

        function previousStep() {
            document.getElementById('step-1').classList.remove('d-none');
            document.getElementById('step-2').classList.add('d-none');
            document.getElementById('prev-btn').disabled = true;
        }
    </script>
@endsection
