@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <!-- Tampilkan error jika ada -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <!-- Field untuk password baru -->
                        <div class="row mb-3">
                            <label for="acc_on" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="acc_on" type="password" class="form-control @error('acc_on') is-invalid @enderror" name="acc_on" required autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('acc_on', this)">
                                        <i class="fas fa-eye"></i> <!-- Ikon mata -->
                                    </button>
                                </div>

                                @error('acc_on')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Field konfirmasi password -->
                        <div class="row mb-3">
                            <label for="acc_on-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <input id="acc_on-confirm" type="password" class="form-control @error('acc_on_confirmation') is-invalid @enderror" name="acc_on_confirmation" required autocomplete="new-password">
                                    <button type="button" class="btn btn-outline-secondary" onclick="togglePassword('acc_on-confirm', this)">
                                        <i class="fas fa-eye"></i> <!-- Ikon mata -->
                                    </button>
                                </div>

                                @error('acc_on_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
