@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Pending Users</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>NIP</th>
                <th>Nama Lengkap</th>
                <th>Email</th>
                <th class="text-center">Action</th> <!-- Centered header -->
            </tr>
        </thead>
        <tbody>
            @foreach($pendingUsers as $user)
                <tr>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ $user->email }}</td>
                    <td class="text-center"> <!-- Centered content -->
                        <a href="{{ route('admin.user.detail', $user->id) }}" class="btn btn-secondary">Manage Users</a>
                        <form action="{{ route('admin.approve', $user) }}" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Approve</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
