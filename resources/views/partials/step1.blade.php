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