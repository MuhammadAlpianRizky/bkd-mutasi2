@extends('layouts.auth')

@section('content')

@include('users.navigation')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
        <div class="col-lg-4 col-md-7 bg-white shadow" id="reg-card" style="margin: 100px 10px 35px 10px">
            <div class="p-4">
                <div class="text-center">
                    <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="wrapkit" style="height: 70px; width: 50px;">
                </div>
                <h2 class="mt-3 text-center" style="color: black;">Register</h2>
                <p class="text-center" style="font-size: 15px; color: black;">Silahkan mengisi detail di bawah untuk membuat Akun.</p>

                <form class="mt-4" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">NIP</label>
                                <input class="form-control @error('nip') is-invalid @enderror" id="nip" name="nip" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);" value="{{ old('nip') }}" required autocomplete="nip" autofocus placeholder="Masukkan NIP hanya angka" style="border-radius: 5px;" maxlength="18">
                                @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nama_lengkap">Nama Lengkap</label>
                                <input class="form-control @error('nama_lengkap') is-invalid @enderror" id="nama_lengkap" name="nama_lengkap"  type="text" value="{{ old('nama_lengkap') }}" required autocomplete="nama_lengkap" placeholder="Masukkan nama lengkap Anda" style="border-radius: 5px;">
                                @error('nama_lengkap')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="alamat_tinggal">Alamat Tinggal</label>
                                <textarea class="form-control @error('alamat_tinggal') is-invalid @enderror" id="alamat_tinggal" name="alamat_tinggal" required autocomplete="alamat_tinggal" rows="3" placeholder="Masukkan alamat lengkap Anda" style="border-radius: 5px;">{{ old('alamat_tinggal') }}</textarea>
                                @error('alamat_tinggal')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_hp">Nomor HP/WA</label>
                                <input class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp" type="number" value="{{ old('no_hp') }}" required autocomplete="no_hp" placeholder="Masukkan nomor HP hanya angka" style="border-radius: 5px;" maxlength="15" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);">
                                @error('no_hp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="email">Email Aktif</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" name="email" type="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Masukkan email dalam huruf kecil" style="border-radius: 5px;">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_ktp">Nomor KTP</label>
                                <input class="form-control @error('no_ktp') is-invalid @enderror" id="no_ktp" name="no_ktp" type="number" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" placeholder="Masukkan nomor KTP hanya angka" style="border-radius: 5px;" maxlength="16" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 16);">
                                @error('no_ktp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="no_karpeg">Nomor Karpeg</label>
                                <input class="form-control @error('no_karpeg') is-invalid @enderror" id="no_karpeg" name="no_karpeg" type="text" value="{{ old('no_karpeg') }}" required autocomplete="no_karpeg" placeholder="Masukkan nomor Karpeg" style="border-radius: 5px;">
                                @error('no_karpeg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="photo_ktp">Foto KTP</label>
                                <input class="form-control @error('photo_ktp') is-invalid @enderror" id="photo_ktp" name="photo_ktp" type="file" accept="image/*" required style="border-radius: 5px;">
                                <small class="form-text text-danger">Unggah file gambar (jpg, png, jpeg) maksimal 500KB.</small>
                                @error('photo_ktp')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="photo_karpeg">Foto Karpeg</label>
                                <input class="form-control @error('photo_karpeg') is-invalid @enderror" id="photo_karpeg" name="photo_karpeg" type="file" accept="image/*" required style="border-radius: 5px;">
                                <small class="form-text text-danger">Unggah file gambar (jpg, png, jpeg) maksimal 500KB.</small>
                                @error('photo_karpeg')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on">Password</label>
                                <div class="input-group">
                                    <input class="form-control @error('acc_on') is-invalid @enderror" id="acc_on" name="acc_on" type="password" required autocomplete="new-acc_on" placeholder="Masukkan password minimal 8 karakter" style="border-radius: 5px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                @error('acc_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
    
                        <!-- Confirm Password field with show/hide functionality -->
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on_confirmation">Konfirmasi Password</label>
                                <div class="input-group">
                                    <input class="form-control" id="acc_on_confirmation" name="acc_on_confirmation" type="password" required autocomplete="new-acc_on" placeholder="Masukkan ulang password" style="border-radius: 5px;">
                                    <div class="input-group-append">
                                        <span class="input-group-text" id="togglePasswordConfirm" style="cursor: pointer;">
                                            <i class="fa fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn w-100 btn-dark" style="color: white; background-color: #0e1221; border-radius: 5px;">Register</button>
                        </div>
    
                        <div class="col-lg-12 text-center mt-5"  style="color: #222831">
                            Sudah punya akun? <a href="{{ route('login') }}" style="font-weight: 700; color: black">Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- JavaScript for toggling password visibility -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#acc_on');
        
        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    
        const togglePasswordConfirm = document.querySelector('#togglePasswordConfirm');
        const confirmPasswordField = document.querySelector('#acc_on_confirmation');
        
        togglePasswordConfirm.addEventListener('click', function () {
            // Toggle the type attribute
            const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
            confirmPasswordField.setAttribute('type', type);
            
            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
    
    @endsection