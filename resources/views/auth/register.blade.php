@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <!-- Formulir pendaftaran dengan enctype multipart/form-data -->
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="nip" class="col-md-4 col-form-label text-md-end">{{ __('NIP') }}</label>
                            <div class="col-md-6">
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus placeholder="Masukkan NIP hanya angka">
                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="nama_lengkap" class="col-md-4 col-form-label text-md-end">{{ __('Nama Lengkap') }}</label>
                            <div class="col-md-6">
                                <input id="nama_lengkap" type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" placeholder="Masukkan nama lengkap Anda">
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="alamat_tinggal" class="col-md-4 col-form-label text-md-end">{{ __('Alamat Tinggal') }}</label>
                            <div class="col-md-6">
                                <textarea id="alamat_tinggal" class="form-control @error('alamat_tinggal') is-invalid @enderror" name="alamat_tinggal" required autocomplete="alamat_tinggal" rows="5" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat_tinggal') }}</textarea>
                                @error('alamat_tinggal')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_hp" class="col-md-4 col-form-label text-md-end">{{ __('Nomor HP/WA') }}</label>
                            <div class="col-md-6">
                                <input id="no_hp" type="text" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}" required autocomplete="no_hp" placeholder="Masukkan nomor HP hanya angka">
                                @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Aktif') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email dalam huruf kecil">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_ktp" class="col-md-4 col-form-label text-md-end">{{ __('Nomor KTP') }}</label>
                            <div class="col-md-6">
                                <input id="no_ktp" type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" placeholder="Masukkan nomor KTP hanya angka">
                                @error('no_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="no_karpeg" class="col-md-4 col-form-label text-md-end">{{ __('Nomor Karpeg') }}</label>
                            <div class="col-md-6">
                                <input id="no_karpeg" type="text" class="form-control @error('no_karpeg') is-invalid @enderror" name="no_karpeg" value="{{ old('no_karpeg') }}" required autocomplete="no_karpeg" placeholder="Masukkan nomor Karpeg hanya angka">
                                @error('no_karpeg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo_ktp" class="col-md-4 col-form-label text-md-end">{{ __('Foto KTP') }}</label>
                            <div class="col-md-6">
                                <input id="photo_ktp" type="file" class="form-control @error('photo_ktp') is-invalid @enderror" name="photo_ktp" accept="image/*" required>
                                <small class="form-text text-muted">Unggah file gambar (jpg, png, jpeg) maksimal 2MB.</small>
                                @error('photo_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="photo_karpeg" class="col-md-4 col-form-label text-md-end">{{ __('Foto Karpeg') }}</label>
                            <div class="col-md-6">
                                <input id="photo_karpeg" type="file" class="form-control @error('photo_karpeg') is-invalid @enderror" name="photo_karpeg" accept="image/*" required>
                                <small class="form-text text-muted">Unggah file gambar (jpg, png, jpeg) maksimal 2MB.</small>
                                @error('photo_karpeg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="acc_on" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="acc_on" type="password" class="form-control @error('acc_on') is-invalid @enderror" name="acc_on" required autocomplete="new-acc_on" placeholder="Masukkan password minimal 8 karakter">
                                @error('acc_on')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="acc_on-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="acc_on-confirm" type="password" class="form-control" name="acc_on_confirmation" required autocomplete="new-acc_on" placeholder="Masukkan ulang password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
