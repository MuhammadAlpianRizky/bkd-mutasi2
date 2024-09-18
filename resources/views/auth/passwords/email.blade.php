@extends('layouts.auth')

@section('content')

<div class="auth-wrapper d-flex no-block justify-content-center align-items-center position-relative">
        <div class="col-lg-4 col-md-7 bg-white shadow" style="border-radius: 10px; overflow: hidden;">
            <div class="p-5">
                <div class="text-center">
                    <img src="{{ asset('landing-page/assets/img/logo.png') }}" alt="wrapkit" style="height: 70px; width: 50px;">
                </div>

                <h2 class="mt-3 text-center" style="color: black;">Reset Password</h2>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">NIP</label>
                                <input id="nip" type="text" class="form-control @error('nip') is-invalid @enderror" name="nip" value="{{ old('nip') }}" required autocomplete="nip" autofocus style="border-radius: 5px;">

                                @error('nip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <!-- Field untuk nomor KTP -->
                       <div class="form-group mb-3">
                                <label class="form-label text-dark" for="nip">Nomor KTP</label>
                                <input id="no_ktp" type="text" class="form-control @error('no_ktp') is-invalid @enderror" name="no_ktp" value="{{ old('no_ktp') }}" required autocomplete="no_ktp" autofocus style="border-radius: 5px;">

                                @error('no_ktp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <!-- Field untuk nomor karpeg -->
                        <div class="form-group mb-3">
                            <label class="form-label text-dark" for="nip">Nomor KarPeg</label>
                                <input id="no_karpeg" type="text" class="form-control @error('no_karpeg') is-invalid @enderror" name="no_karpeg" value="{{ old('no_karpeg') }}" required autocomplete="no_karpeg" autofocus style="border-radius: 5px;">

                                @error('no_karpeg')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn w-100" style="color: white; background-color: #0e1221; border-radius: 5px;">Kirim Link Reset Password</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
