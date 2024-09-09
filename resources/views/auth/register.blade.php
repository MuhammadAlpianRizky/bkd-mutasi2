@extends('layouts.auth')

@section('content')
<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative"
    style="background:url(../assets/images/big/auth-bg.jpg) no-repeat center center;">
    <div class="auth-box row">
        <div class="col-lg-7 col-md-5 modal-bg-img" style="background-image: url(../assets/images/big/3.jpg);">
        </div>
        <div class="col-lg-5 col-md-7 bg-white">
            <div class="p-3">
                <div class="text-center">
                    <img src="../assets/images/big/icon.png" alt="wrapkit">
                </div>
                <h2 class="mt-3 text-center">Register</h2>
                <p class="text-center">Fill in the details below to create a new account.</p>

                <form class="mt-4" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">NIP</label>
                                <input class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" type="number" value="{{ old('nip') }}" required autocomplete="nip" autofocus placeholder="Masukkan NIP hanya angka">
                                @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nama_lengkap">Nama Lengkap</label>
                                <input class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap" type="text" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" placeholder="Masukkan nama lengkap Anda">
                                @error('nama_lengkap')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="alamat_tinggal">Alamat Tinggal</label>
                                <textarea class="form-control @error('alamat_tinggal') is-invalid @enderror" id="alamat_tinggal" name="alamat_tinggal" required autocomplete="alamat_tinggal" rows="3" placeholder="Masukkan alamat lengkap Anda">{{ old('alamat_tinggal') }}</textarea>
                                @error('alamat_tinggal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_hp">Nomor HP/WA</label>
                                <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" type="number" value="{{ old('no_hp') }}" required autocomplete="no_hp" placeholder="Masukkan nomor HP hanya angka">
                                @error('no_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="email">Email Aktif</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email dalam huruf kecil">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_ktp">Nomor KTP</label>
                                <input class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" type="number" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" placeholder="Masukkan nomor KTP hanya angka">
                                @error('no_ktp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_karpeg">Nomor Karpeg</label>
                                <input class="form-control @error('no_karpeg') is-invalid @enderror" id="no_karpeg" name="no_karpeg" type="number" value="{{ old('no_karpeg') }}" required autocomplete="no_karpeg" placeholder="Masukkan nomor Karpeg hanya angka">
                                @error('no_karpeg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="photo_ktp">Foto KTP</label>
                                <input class="form-control @error('photo_ktp') is-invalid @enderror" id="photo_ktp" name="photo_ktp" type="file" accept="image/*" required>
                                <small class="form-text text-danger">Unggah file gambar (jpg, png, jpeg) maksimal 500KB.</small>
                                @error('photo_ktp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="photo_karpeg">Foto Karpeg</label>
                                <input class="form-control @error('photo_karpeg') is-invalid @enderror" id="photo_karpeg" name="photo_karpeg" type="file" accept="image/*" required>
                                <small class="form-text text-danger">Unggah file gambar (jpg, png, jpeg) maksimal 500KB.</small>
                                @error('photo_karpeg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on">Password</label>
                                <input class="form-control @error('acc_on') is-invalid @enderror" id="acc_on" name="acc_on" type="password" required autocomplete="new-acc_on" placeholder="Masukkan password minimal 8 karakter">
                                @error('acc_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on_confirmation">Confirm Password</label>
                                <input class="form-control" id="acc_on_confirmation" name="acc_on_confirmation" type="password" required autocomplete="new-acc_on" placeholder="Masukkan ulang password">
                            </div>
                        </div>

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn w-100 btn-dark">Register</button>
                        </div>

                        <div class="col-lg-12 text-center mt-5">
                            Already have an account? <a href="{{ route('login') }}" class="text-danger">Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
