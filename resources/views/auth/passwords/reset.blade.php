@extends('layouts.auth')

@section('content')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
    <div class="col-lg-4 col-md-7 bg-white shadow" style="border-radius: 10px; overflow: hidden; margin: 100px 10px 35px 10px">
        <div class="p-5">
            <div class="text-center">
                <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="wrapkit" style="height: 70px; width: 50px;">
            </div>
            <h2 class="mt-3 text-center" style="color: black;">Reset Password</h2>
            <p class="text-center" style="color: black;">Silahkan Atur Ulang Kembali Password Anda.</p>

            <form class="mt-4" method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="acc_on">Password</label>
                            <div class="input-group">
                                <input id="acc_on" type="password" class="form-control @error('acc_on') is-invalid @enderror" name="acc_on" required autocomplete="new-password" placeholder="Enter your new password" style="border-radius: 5px;">
                                <button type="button" class="btn btn-outline-secondary align-items-center" onclick="togglePassword('acc_on', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            @error('acc_on')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="acc_on-confirm">Confirm Password</label>
                            <div class="input-group">
                                <input id="acc_on-confirm" type="password" class="form-control @error('acc_on_confirmation') is-invalid @enderror" name="acc_on_confirmation" required autocomplete="new-password" placeholder="Confirm your new password" style="border-radius: 5px;">
                                <button type="button" class="btn btn-outline-secondary align-items-center" onclick="togglePassword('acc_on-confirm', this)">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>

                            @error('acc_on_confirmation')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-lg-12 text-center">
                        <button type="submit" class="btn w-100" style="color: white; background-color: #0e1221; border-radius: 5px;">Reset Password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk toggle password visibility dan mengganti ikon mata
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
