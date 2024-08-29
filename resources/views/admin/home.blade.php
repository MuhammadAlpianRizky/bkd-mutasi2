@extends('layouts.app')

@section('content')
<div class="container">
    <div class="alert alert-success">
        {{ $welcomeMessage }}
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                    <div class="card-footer">
                        @if (Auth::user()->hasRole('admin'))
                            <a href="{{ route('cms.users') }}" class="btn btn-primary">Pending Users</a>
                            <a href="{{ route('cms.active.users') }}" class="btn btn-success">Aktif Users</a>
                            <a href="{{ route('cms.inactive.users') }}" class="btn btn-warning">Non Aktif Users</a>
                        @endif
                        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
