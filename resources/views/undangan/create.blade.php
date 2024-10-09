@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid" style="margin-top: 20px;">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($errorMessage))
            <div class="alert alert-danger">
                {{ $errorMessage }}
            </div>
        @endif

        <form action="{{ route('undangan.store') }}" method="POST" enctype="multipart/form-data" id="undanganForm">
            @csrf

            <!-- Tanggal Filter -->
            <div class="mb-3">
                <label for="startDate" class="form-label">Filter Tanggal</label>
                <input type="date" id="startDate" class="form-control" value="{{ request('selected_date') }}" onchange="filterMutasi()">
            </div>

            <!-- Daftar Mutasi -->
            <h5>Pilih Pegawai untuk Diundang</h5>
            <div id="mutasiList">
                @forelse($mutasi as $item)
                    <div>
                        <input type="checkbox" name="mutasi_ids[]" value="{{ $item->id }}">
                        <label>{{ $item->nama }} - {{ $item->nip }}-{{ $item->no_registrasi }}</label>
                    </div>
                @empty
                    <p>Tidak ada pegawai untuk tanggal ini.</p>
                @endforelse
            </div>

            <div class="mb-3">
                <label for="file" class="form-label">Upload Undangan (PDF)</label>
                <input type="file" class="form-control" id="file" name="file" required>
            </div>

            <button type="submit" class="btn btn-primary">Kirim Undangan</button>
        </form>
    </div>
</div>

<script>
    // Function to filter mutasi based on the selected date
    function filterMutasi() {
        var selectedDate = document.getElementById('startDate').value;

        // Redirect to the same page with the selected date as a query parameter
        if (selectedDate) {
            window.location.href = `/cms/undangan/create?selected_date=${selectedDate}`;
        } else {
            // Reload without a filter if no date is selected
            window.location.href = `/cms/undangan/create`;
        }
    }
</script>
@endsection
