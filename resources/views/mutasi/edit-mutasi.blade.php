@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 100px; margin-bottom: 70px;">
        <div class="container mt-5">
            <div class="row justify-content-center px-6">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="{{ route('mutasi.update', $mutasi->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Card untuk Data Pribadi (Step 1) -->
                        <div id="step-1" class="card shadow">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="my-2">Pengajuan Mutasi - Data Diri</h4>
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
                        <div id="step-2" class="card d-none shadow">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="my-2">Pengajuan Mutasi - Upload Dokumen</h4>
                            </div>
                            <div class="card-body">
                                @foreach ($persyaratans as $persyaratan)
                                    <div class="row mb-4">
                                        <div class="col-12">
                                            <label for="{{ $persyaratan->id }}" class="form-label fw-bold">{{ $persyaratan->nama_persyaratan }}</label>

                                            @php
                                                // Ambil path file dari tabel upload_persyaratan
                                                $uploadPersyaratan = $mutasi->uploads->where('persyaratan_id', $persyaratan->id)->first();
                                                $filePath = $uploadPersyaratan ? $uploadPersyaratan->file_path : null;
                                            @endphp

                                            @if ($filePath)
                                                <!-- Jika file sudah di-upload -->
                                                <div class="alert alert-success d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                    <span>File sudah di-upload. Anda dapat <a href="{{ Storage::url($filePath) }}" target="_blank" class="text-decoration-none fw-bold">Lihat File</a></span>
                                                    <button type="button" class="btn btn-outline-dark btn-sm mt-2 mt-md-0" onclick="toggleFileInput('{{ $persyaratan->id }}')">Ubah File</button>
                                                </div>

                                                <!-- Kontainer input file untuk ubah file, tersembunyi secara default -->
                                                <div id="fileInputContainer-{{ $persyaratan->id }}" style="display: none;">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="{{ $persyaratan->id }}" name="persyaratan[{{ $persyaratan->id }}]" accept=".{{ $persyaratan->jenis_file }}"
                                                            aria-describedby="upload-help-{{ $persyaratan->id }}" onchange="showFileLink('{{ $persyaratan->id }}', 'view-{{ $persyaratan->id }}')">
                                                        <span class="input-group-append">
                                                            <a id="view-{{ $persyaratan->id }}" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                                <i class="fas fa-eye"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                    <small id="upload-help-{{ $persyaratan->id }}" class="form-text text-danger">Format {{ strtoupper($persyaratan->jenis_file) }}, ukuran maksimal {{ $persyaratan->ukuran }}KB</small>
                                                </div>
                                            @else
                                                <!-- Jika file belum di-upload -->
                                                <div class="input-group mb-3">
                                                    <input type="file" class="form-control" id="{{ $persyaratan->id }}" name="persyaratan[{{ $persyaratan->id }}]" accept=".{{ $persyaratan->jenis_file }}"
                                                        aria-describedby="upload-help-{{ $persyaratan->id }}" onchange="showFileLink('{{ $persyaratan->id }}', 'view-{{ $persyaratan->id }}')">
                                                    <a id="view-{{ $persyaratan->id }}" href="#" target="_blank" class="btn btn-outline-info d-none"
                                                    style="border-color: #17a2b8; color: #17a2b8; display: flex; align-items: center; padding: 0.375rem 0.75rem; font-size: 0.875rem; font-weight: 400; margin-left: -1px;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </div>
                                                <small id="upload-help-{{ $persyaratan->id }}" class="form-text text-danger">Format {{ strtoupper($persyaratan->jenis_file) }}, ukuran maksimal {{ $persyaratan->ukuran }}KB</small>
                                            @endif

                                            <!-- Pesan error validasi -->
                                            @if ($errors->has("persyaratan.{$persyaratan->id}"))
                                                <div class="text-danger mt-2">
                                                    <i class="fas fa-exclamation-triangle"></i> {{ $errors->first("persyaratan.{$persyaratan->id}") }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" id="prev-btn" onclick="previousStep()">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
                                    </button>
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="submit" name="action" value="finish" class="btn btn-warning" id="finish-btn">
                                        <i class="fas fa-save"></i> Selesai
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
