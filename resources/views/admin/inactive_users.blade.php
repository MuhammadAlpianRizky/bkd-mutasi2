@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Inactive Users</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inactiveUsers as $user)
                <tr>
                    <td>{{ $user->nama_lengkap }}</td>
                    <td>{{ $user->nip }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('cms.user.detail', $user->id) }}" class="btn btn-secondary">Detail</a>
                            <form action="{{ route('cms.activate', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-success">Aktifkan</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
