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
                <h2 class="mt-3 text-center">Login</h2>
                <p class="text-center">SIMUT BKD - Pemko Banjarmasin</p>
                
                <form class="mt-4" method="POST" action="{{ route('login') }}"> <!-- Updated route -->
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">NIP</label>
                                <input class="form-control" id="nip" name="nip" type="text" placeholder="Enter your NIP" required>
                                @error('nip')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="acc_on">Password</label>
                                <input class="form-control" id="acc_on" name="acc_on" type="password" placeholder="Enter your password" required>
                                @error('acc_on')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if (Route::has('password.request'))
                            <div class="col-lg-12 text-center mb-3">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Password?') }}
                                </a>
                            </div>
                        @endif

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn w-100 btn-dark">Login</button>
                        </div>

                        <div class="col-lg-12 text-center mt-5">
                            Belum memiliki akun? <a href="{{ route('register') }}" class="text-danger">Register</a>
                        </div>
                    </div>
                </form>
            </div>
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

@endsection
