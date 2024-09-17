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
                                <h4 class="mb-0">Pengajuan Mutasi - Data Diri</h4>
                            </div>
                            <div class="card-body">

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif


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
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $mutasi->no_hp) }}">
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
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
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
                                <h4 class="mb-0">Pengajuan Mutasi - Upload Dokumen</h4>
                            </div>
                            <div class="card-body">
                                {{-- SK CPNS --}}
                            <div class="row mb-4">
                                <div class="col-12">
                                    <label for="sk_cpns" class="form-label fw-bold">Copy + Legalisir SK CPNS</label>
                                    @if ($mutasi->sk_cpns)
                                        <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                            <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_cpns) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                            <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_cpns')">Ubah File</button>
                                        </div>
                                        <div id="fileInputContainer-sk_cpns" style="display: none;">
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf"
                                                    aria-describedby="upload-help-sk_cpns" onchange="showFileLink('sk_cpns', 'view-sk_cpns')">
                                                <span class="input-group-append">
                                                    <a id="view-sk_cpns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <small id="upload-help-sk_cpns" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        </div>
                                    @else
                                        <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf"
                                                aria-describedby="upload-help-sk_cpns" onchange="showFileLink('sk_cpns', 'view-sk_cpns')">
                                            <a id="view-sk_cpns" href="#" target="_blank" class="btn btn-outline-info d-none"
                                            style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                        <small id="upload-help-sk_cpns" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                    @endif
                                    @if ($errors->has('sk_cpns'))
                                        <div class="text-danger mt-2">
                                            <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_cpns') }}
                                        </div>
                                    @endif
                                </div>
                            </div>


                                {{-- SK PNS --}}
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="sk_pns" class="form-label fw-bold">Copy + Legalisir SK PNS</label>
                                        @if ($mutasi->sk_pns)
                                            <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_pns) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_pns')">Ubah File</button>
                                            </div>
                                            <div id="fileInputContainer-sk_pns" style="display: none;">
                                                <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf"
                                                    aria-describedby="upload-help-sk_pns" onchange="showFileLink('sk_pns', 'view-sk_pns')">
                                                <small id="upload-help-sk_pns" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf"
                                                    aria-describedby="upload-help-sk_pns" onchange="showFileLink('sk_pns', 'view-sk_pns')">
                                                <a id="view-sk_pns" href="{{ $mutasi->sk_pns ? Storage::url($mutasi->sk_pns) : '#' }}"
                                                target="_blank"
                                                class="btn btn-outline-info {{ $mutasi->sk_pns ? '' : 'd-none' }}"
                                                style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <small id="upload-help-sk_pns" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        @endif
                                        @if ($errors->has('sk_pns'))
                                            <div class="text-danger mt-2">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_pns') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- SK Pangkat Terakhir --}}
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="sk_pangkat_terakhir" class="form-label fw-bold">Copy + Legalisir SK Pangkat Terakhir</label>
                                        @if ($mutasi->sk_pangkat_terakhir)
                                            <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_pangkat_terakhir) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_pangkat_terakhir')">Ubah File</button>
                                            </div>
                                            <div id="fileInputContainer-sk_pangkat_terakhir" style="display: none;">
                                                <input type="file" class="form-control" id="sk_pangkat_terakhir" name="sk_pangkat_terakhir" accept=".pdf"
                                                    aria-describedby="upload-help-sk_pangkat_terakhir" onchange="showFileLink('sk_pangkat_terakhir', 'view-sk_pangkat_terakhir')">
                                                <small id="upload-help-sk_pangkat_terakhir" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="sk_pangkat_terakhir" name="sk_pangkat_terakhir" accept=".pdf"
                                                    aria-describedby="upload-help-sk_pangkat_terakhir" onchange="showFileLink('sk_pangkat_terakhir', 'view-sk_pangkat_terakhir')">
                                                <a id="view-sk_pangkat_terakhir" href="{{ $mutasi->sk_pangkat_terakhir ? Storage::url($mutasi->sk_pangkat_terakhir) : '#' }}"
                                                target="_blank"
                                                class="btn btn-outline-info {{ $mutasi->sk_pangkat_terakhir ? '' : 'd-none' }}"
                                                style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <small id="upload-help-sk_pangkat_terakhir" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        @endif
                                        @if ($errors->has('sk_pangkat_terakhir'))
                                            <div class="text-danger mt-2">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_pangkat_terakhir') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- SK Jabatan Struktural --}}
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="sk_jabatan_struktural" class="form-label fw-bold">Copy + Legalisir SK Jabatan Struktural</label>
                                        @if ($mutasi->sk_jabatan_struktural)
                                            <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_jabatan_struktural) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_jabatan_struktural')">Ubah File</button>
                                            </div>
                                            <div id="fileInputContainer-sk_jabatan_struktural" style="display: none;">
                                                <input type="file" class="form-control" id="sk_jabatan_struktural" name="sk_jabatan_struktural" accept=".pdf"
                                                    aria-describedby="upload-help-sk_jabatan_struktural" onchange="showFileLink('sk_jabatan_struktural', 'view-sk_jabatan_struktural')">
                                                <small id="upload-help-sk_jabatan_struktural" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="sk_jabatan_struktural" name="sk_jabatan_struktural" accept=".pdf"
                                                    aria-describedby="upload-help-sk_jabatan_struktural" onchange="showFileLink('sk_jabatan_struktural', 'view-sk_jabatan_struktural')">
                                                <a id="view-sk_jabatan_struktural" href="{{ $mutasi->sk_jabatan_struktural ? Storage::url($mutasi->sk_jabatan_struktural) : '#' }}"
                                                target="_blank"
                                                class="btn btn-outline-info {{ $mutasi->sk_jabatan_struktural ? '' : 'd-none' }}"
                                                style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <small id="upload-help-sk_jabatan_struktural" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        @endif
                                        @if ($errors->has('sk_jabatan_struktural'))
                                            <div class="text-danger mt-2">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_jabatan_struktural') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- SK Jabatan Fungsional --}}
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="sk_jabatan_fungsional" class="form-label fw-bold">Copy + Legalisir SK Jabatan Fungsional</label>
                                        @if ($mutasi->sk_jabatan_fungsional)
                                            <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_jabatan_fungsional) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_jabatan_fungsional')">Ubah File</button>
                                            </div>
                                            <div id="fileInputContainer-sk_jabatan_fungsional" style="display: none;">
                                                <input type="file" class="form-control" id="sk_jabatan_fungsional" name="sk_jabatan_fungsional" accept=".pdf"
                                                    aria-describedby="upload-help-sk_jabatan_fungsional" onchange="showFileLink('sk_jabatan_fungsional', 'view-sk_jabatan_fungsional')">
                                                <small id="upload-help-sk_jabatan_fungsional" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="sk_jabatan_fungsional" name="sk_jabatan_fungsional" accept=".pdf"
                                                    aria-describedby="upload-help-sk_jabatan_fungsional" onchange="showFileLink('sk_jabatan_fungsional', 'view-sk_jabatan_fungsional')">
                                                <a id="view-sk_jabatan_fungsional" href="{{ $mutasi->sk_jabatan_fungsional ? Storage::url($mutasi->sk_jabatan_fungsional) : '#' }}"
                                                target="_blank"
                                                class="btn btn-outline-info {{ $mutasi->sk_jabatan_fungsional ? '' : 'd-none' }}"
                                                style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <small id="upload-help-sk_jabatan_fungsional" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        @endif
                                        @if ($errors->has('sk_jabatan_fungsional'))
                                            <div class="text-danger mt-2">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_jabatan_fungsional') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                {{-- SK Berkala Terakhir --}}
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <label for="sk_berkala_terakhir" class="form-label fw-bold">Copy + Legalisir SK Berkala Terakhir</label>
                                        @if ($mutasi->sk_berkala_terakhir)
                                            <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($mutasi->sk_berkala_terakhir) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('sk_berkala_terakhir')">Ubah File</button>
                                            </div>
                                            <div id="fileInputContainer-sk_berkala_terakhir" style="display: none;">
                                                <input type="file" class="form-control" id="sk_berkala_terakhir" name="sk_berkala_terakhir" accept=".pdf"
                                                    aria-describedby="upload-help-sk_berkala_terakhir" onchange="showFileLink('sk_berkala_terakhir', 'view-sk_berkala_terakhir')">
                                                <small id="upload-help-sk_berkala_terakhir" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                            </div>
                                        @else
                                            <div class="input-group mb-3">
                                                <input type="file" class="form-control" id="sk_berkala_terakhir" name="sk_berkala_terakhir" accept=".pdf"
                                                    aria-describedby="upload-help-sk_berkala_terakhir" onchange="showFileLink('sk_berkala_terakhir', 'view-sk_berkala_terakhir')">
                                                <a id="view-sk_berkala_terakhir" href="{{ $mutasi->sk_berkala_terakhir ? Storage::url($mutasi->sk_berkala_terakhir) : '#' }}"
                                                target="_blank"
                                                class="btn btn-outline-info {{ $mutasi->sk_berkala_terakhir ? '' : 'd-none' }}"
                                                style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                            </div>
                                            <small id="upload-help-sk_berkala_terakhir" class="form-text text-danger">Format PDF, ukuran maksimal 500KB</small>
                                        @endif
                                        @if ($errors->has('sk_berkala_terakhir'))
                                            <div class="text-danger mt-2">
                                                <i class="fas fa-exclamation-triangle"></i> {{ $errors->first('sk_berkala_terakhir') }}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" id="prev-btn" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="submit" name="action" value="finish" class="btn btn-warning" id="finish-btn">
                                        <i class="fas fa-save"></i> Kirim
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
    <script src="{{ asset('js-mutasi/mutasi.js') }}"></script>
@endsection
