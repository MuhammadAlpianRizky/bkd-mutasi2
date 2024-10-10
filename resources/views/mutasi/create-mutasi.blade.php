@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 100px; margin-bottom: 70px;">
        <div class="container mt-5">
            <div class="row justify-content-center px-6">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="{{ route('mutasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Card untuk Data Pribadi (Step 1) -->
                        <div id="step-1" class="card shadow">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="my-2">Pengajuan Mutasi - Data Diri</h4>
                            </div>
                            <div class="card-body m-3">

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
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama_lengkap) }}" readonly>
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
                                            <input type="number" class="form-control" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" readonly>
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
                                            <input type="text" class="form-control" id="pgol" name="pgol">
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
                                            <input type="text" class="form-control" id="jabatan" name="jabatan">
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
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja">
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
                                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi') }}">
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
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" readonly>
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
                                    <button type="button" class="btn btn-dark" onclick="nextStep()">
                                        <i class="fas fa-arrow-right"></i> Berikutnya
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Card untuk Upload File (Step 2) -->
                        <div id="step-2" class="card d-none shadow-lg">
                            <div class="card-header bg-dark text-white text-center">
                                <h4 class="mb-0">Pengajuan Mutasi - Upload Dokumen </h4>
                            </div>
                            <div class="card-body">
                                @foreach ($persyaratans as $persyaratan)
                                    @if($persyaratan->status == 1)
                                        <div class="mb-4">
                                            <label for="{{ $persyaratan->id }}" class="form-label">{{ $persyaratan->nama_persyaratan }}</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" id="file-{{ $persyaratan->id }}" name="persyaratan[{{ $persyaratan->id }}]" accept=".{{ $persyaratan->jenis_file }}"
                                                    onchange="validateFileUpload('{{ $persyaratan->id }}', '{{ $persyaratan->ukuran }}')">
                                                <span class="input-group-append">
                                                    <a id="view-{{ $persyaratan->id }}" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </span>
                                            </div>
                                            <small class="text-secondary">Format {{ strtoupper($persyaratan->jenis_file) }}, ukuran maksimal {{ $persyaratan->ukuran }}KB</small>

                                            <!-- Elemen untuk menampilkan pesan validasi -->
                                            <div id="validation-message-{{ $persyaratan->id }}" class="text-danger mt-2"></div>

                                            @error("persyaratan[{$persyaratan->id}]")
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @endif
                                @endforeach

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="button" class="btn btn-secondary" onclick="previousStep()" id="prev-btn">
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
