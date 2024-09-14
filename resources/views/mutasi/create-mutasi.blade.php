@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Form untuk semua langkah -->
                    <form id="mutasiForm" action="{{ route('mutasi.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

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
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama_lengkap) }}" required>
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
                                            <input type="number" class="form-control" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" required>
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
                                            <input type="text" class="form-control" id="pgol" name="pgol">
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
                                            <input type="text" class="form-control" id="jabatan" name="jabatan">
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
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja">
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
                                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi') }}">
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
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
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
                                {{-- Copy + legalisir SK CPNS --}}
                                <div class="mb-4">
                                    <label for="sk_cpns" class="form-label">Copy + legalisir SK CPNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf"
                                            onchange="showFileLink('sk_cpns', 'view-sk_cpns')">
                                        <span class="input-group-append">
                                            <a id="view-sk_cpns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_cpns'))
                                        <div class="text-danger">{{ $errors->first('sk_cpns') }}</div>
                                    @endif
                                </div>


                                {{-- Copy + legalisir SK PNS --}}
                                <div class="mb-4">
                                    <label for="sk_pns" class="form-label">Copy + legalisir SK PNS</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf"
                                            onchange="showFileLink('sk_pns', 'view-sk_pns')">
                                        <span class="input-group-append">
                                            <a id="view-sk_pns" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_pns'))
                                        <div class="text-danger">{{ $errors->first('sk_pns') }}</div>
                                    @endif
                                </div>

                                {{-- Copy + legalisir SK Pangkat Terakhir --}}
                                <div class="mb-4">
                                    <label for="sk_pangkat_terakhir" class="form-label">Copy + legalisir SK Pangkat Terakhir</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_pangkat_terakhir" name="sk_pangkat_terakhir" accept=".pdf"
                                            onchange="showFileLink('sk_pangkat_terakhir', 'view-sk_pangkat_terakhir')">
                                        <span class="input-group-append">
                                            <a id="view-sk_pangkat_terakhir" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_pangkat_terakhir'))
                                        <div class="text-danger">{{ $errors->first('sk_pangkat_terakhir') }}</div>
                                    @endif
                                </div>

                                {{-- Copy + legalisir SK Jabatan Struktural --}}
                                <div class="mb-4">
                                    <label for="sk_jabatan_struktural" class="form-label">Copy + legalisir SK Jabatan Struktural</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_jabatan_struktural" name="sk_jabatan_struktural" accept=".pdf"
                                            onchange="showFileLink('sk_jabatan_struktural', 'view-sk_jabatan_struktural')">
                                        <span class="input-group-append">
                                            <a id="view-sk_jabatan_struktural" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_jabatan_struktural'))
                                        <div class="text-danger">{{ $errors->first('sk_jabatan_struktural') }}</div>
                                    @endif
                                </div>

                                {{-- Copy + legalisir SK Jabatan Fungsional --}}
                                <div class="mb-4">
                                    <label for="sk_jabatan_fungsional" class="form-label">Copy + legalisir SK Jabatan Fungsional</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_jabatan_fungsional" name="sk_jabatan_fungsional" accept=".pdf"
                                            onchange="showFileLink('sk_jabatan_fungsional', 'view-sk_jabatan_fungsional')">
                                        <span class="input-group-append">
                                            <a id="view-sk_jabatan_fungsional" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_jabatan_fungsional'))
                                        <div class="text-danger">{{ $errors->first('sk_jabatan_fungsional') }}</div>
                                    @endif
                                </div>

                                {{-- Copy + legalisir SK Berkala Terakhir --}}
                                <div class="mb-4">
                                    <label for="sk_berkala_terakhir" class="form-label">Copy + legalisir SK Berkala Terakhir</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="sk_berkala_terakhir" name="sk_berkala_terakhir" accept=".pdf"
                                            onchange="showFileLink('sk_berkala_terakhir', 'view-sk_berkala_terakhir')">
                                        <span class="input-group-append">
                                            <a id="view-sk_berkala_terakhir" href="#" target="_blank" class="btn btn-outline-info d-none">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </span>
                                    </div>
                                    <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>

                                    @if ($errors->has('sk_berkala_terakhir'))
                                        <div class="text-danger">{{ $errors->first('sk_berkala_terakhir') }}</div>
                                    @endif
                                </div>

                                <!-- Navigasi Step -->
                                <div class="d-grid gap-2">
                                    <button type="submit" name="action" value="save" class="btn btn-dark">
                                        <i class="fas fa-save"></i> Simpan
                                    </button>
                                    <button type="button" class="btn btn-secondary" onclick="previousStep()" id="prev-btn">
                                        <i class="fas fa-arrow-left"></i> Sebelumnya
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
