@extends('users.dashboard')

@section('content')
    <div class="container" style="margin-top: 50px; margin-bottom: 250px">
        <h2>Daftar Mutasi</h2>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>No. Registrasi</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mutasi as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->no_registrasi }}</td>
                        <td>{{ $item->status }}</td>
                        <td>
                            @if($item->status != 'selesai')
                                <a href="#" class="btn btn-warning btn-sm">Edit</a>
                            @else
                                <button class="btn btn-secondary btn-sm" disabled>Edit</button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
