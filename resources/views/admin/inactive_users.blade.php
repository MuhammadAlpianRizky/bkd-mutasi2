@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inactive Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveUsers as $user)
                <tr>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form action="{{ route('cms.activate', $user->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Activate</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
