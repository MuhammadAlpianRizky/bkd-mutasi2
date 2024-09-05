@extends('users.dashboard')

@section('content')
    <main class="content" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-7">
                    <!-- Card untuk Data Pribadi -->
                    <div id="step-1" class="card">
                        <div class="card-header bg-dark text-white" style="text-align: center">
                            Form Pengajuan Mutasi - Data Diri
                        </div>
                        <div class="card-body">
                            <form id="mutasiForm" action="#" method="POST" enctype="multipart/form-data">
                                @csrf

                                <div class="mb-4 row">
                                    <label for="no_reg" class="col-sm-4 col-form-label">No. Registrasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ $registrationNumber }}" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="nama" class="col-sm-4 col-form-label">Nama</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama', $user->nama_lengkap) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="nip" class="col-sm-4 col-form-label">NIP</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="nip" name="nip" value="{{ old('nip', $user->nip) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="pgol" class="col-sm-4 col-form-label">Pangkat/Gol. Ruang</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="pgol" name="pgol" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="jabatan" class="col-sm-4 col-form-label">Jabatan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="jabatan" name="jabatan" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="unit_kerja" class="col-sm-4 col-form-label">Unit Kerja</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="instansi" class="col-sm-4 col-form-label">Instansi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="instansi" name="instansi" value="{{ old('instansi') }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="mb-4 row">
                                    <label for="no_hp" class="col-sm-4 col-form-label">No. HP</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="number" class="form-control" id="no_hp" name="no_hp" value="{{ old('no_hp', $user->no_hp) }}" required>
                                            <span class="input-group-text">
                                                <i class="fas fa-pencil-alt"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <button type="button" class="btn btn-dark w-100" onclick="nextStep()">Berikutnya</button>
                            </form>
                        </div>
                    </div>

                    <!-- Card untuk Upload File -->
                    <div id="step-2" class="card d-none">
                        <div class="card-header bg-dark text-white" style="text-align: center">
                            Form Pengajuan Mutasi - Upload Dokumen
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="sk_cpns" class="form-label">Upload File SK CPNS</label>
                                <input type="file" class="form-control" id="sk_cpns" name="sk_cpns" accept=".pdf" required>
                                <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>
                            </div>
                            <div class="mb-3">
                                <label for="sk_pns" class="form-label">Upload File SK PNS</label>
                                <input type="file" class="form-control" id="sk_pns" name="sk_pns" accept=".pdf" required>
                                <small class="text-danger">Format PDF, ukuran maksimal 500KB</small>
                            </div>
                            <button type="button" class="btn btn-secondary w-100 mb-2" onclick="previousStep()">Sebelumnya</button>
                            <button type="submit" class="btn btn-warning w-100">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function nextStep() {
            document.getElementById('step-1').classList.add('d-none');
            document.getElementById('step-2').classList.remove('d-none');
        }

        function previousStep() {
            document.getElementById('step-2').classList.add('d-none');
            document.getElementById('step-1').classList.remove('d-none');
        }
    </script>
@endsection
