@extends('layouts.auth')

@section('content')

@include('users.navigation')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
    <div class="col-lg-4 col-md-7 bg-white shadow" style="border-radius: 10px; overflow: hidden; margin: 100px 10px 35px 10px">
        <div class="p-4">
            <div class="text-center">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="wrapkit" style="height: 70px; width: 50px;">
            </div>
            <h2 class="mt-3 text-center" style="color: black;">Login</h2>
            <p class="text-center" style="color: black;">SIMUT BKD DIKLAT BANJARMASIN</p>

            <form class="mt-4" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="nip">NIP</label>
                            <input class="form-control" id="nip" name="nip" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 18);" placeholder="Masukkan NIP Anda" required style="border-radius: 5px;">
                            @error('nip')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="acc_on">Password</label>
                            <div class="input-group">
                                <input class="form-control" id="acc_on" name="acc_on" type="password" placeholder="Masukkan Password Anda" required style="border-radius: 5px;">
                                <button type="button" class="btn btn-outline-secondary align-items-center" onclick="togglePassword('acc_on', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('acc_on')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Random Addition Problem -->
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="captcha">Selesaikan Hitungan: <span id="randomAddition"></span></label>
                            <input class="form-control" id="captcha" name="captcha" type="number" placeholder="Masukkan Hasil" required style="border-radius: 5px;">
                            <input type="hidden" id="captcha_result" name="captcha_result"> <!-- Hidden field for result -->
                            @error('captcha')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="col-lg-12 text-center mb-3">
                            <a class="btn btn-link" style="text-decoration: none;" href="{{ route('password.request') }}">
                                {{ __('Lupa Password?') }}
                            </a>
                        </div>
                    @endif

                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn w-100" style="color: white; background-color: #0e1221; border-radius: 5px;">Login</button>
                    </div>

                    <div class="col-lg-12 text-center mt-5" style="color: #222831">
                        Belum memiliki akun? <a href="{{ route('register') }}" style="font-weight: 700; color: black">Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SweetAlert Integration -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Login Gagal',
            html: `
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            `,
            confirmButtonText: 'OK'
        });
    </script>
@endif

<script>
    // Fungsi untuk generate dua angka random dengan hasil antara 0 sampai 99
    document.addEventListener("DOMContentLoaded", function() {
        var num1 = Math.floor(Math.random() * 50);
        var num2 = Math.floor(Math.random() * 50);
        var sum = num1 + num2;

        document.getElementById('randomAddition').innerText = `${num1} + ${num2}`;
        
        // Simpan hasil hitungan di hidden input field untuk dikirim ke server
        document.getElementById('captcha_result').value = sum;
    });

    // Fungsi untuk toggle password visibility dan ikon
    function togglePassword(fieldId, button) {
        var field = document.getElementById(fieldId);
        var type = field.getAttribute('type') === 'password' ? 'text' : 'password';
        field.setAttribute('type', type);

        // Ganti ikon mata
        var icon = button.querySelector('i');
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    }
</script>

@endsection
