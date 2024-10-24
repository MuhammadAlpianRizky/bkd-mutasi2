@extends('users.dashboard')

@section('content')
    <div class="container" style="margin-top: 100px;">
        <h2 class="mb-4">Riwayat Mutasi</h2>

        @if(session('success'))
            <div class="alert alert-info alert-dismissible fade show mb-4" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="mb-4">
            <a href="javascript:void(0);" class="btn btn-primary" id="tambahMutasiBtn">
                <i class="fas fa-plus"></i> Tambah Mutasi
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped align-middle">
                        <thead class="table-success">
                            <tr>
                                <th style="width: 5%;" class="text-center">No</th>
                                <th style="width: 15%;" class="text-center">No. Registrasi</th>
                                <th style="width: 10%;" class="text-center">Status</th>
                                <th style="width: 40%;">Keterangan</th>
                                <th style="width: 10%;" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($mutasi as $index => $item)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td class="text-center">{{ $item->no_registrasi }}</td>
                                    <td class="text-center">
                                        @switch($item->status)
                                            @case('draft')
                                                <span class="badge bg-secondary rounded-pill">Draft</span>
                                                @break
                                            @case('proses')
                                                <span class="badge bg-info rounded-pill">Proses</span>
                                                @break
                                            @case('diterima')
                                                <span class="badge bg-success rounded-pill">Diterima</span>
                                                @break
                                            @case('ditolak')
                                                <span class="badge bg-danger rounded-pill">Ditolak</span>
                                                @break
                                            @case('dibatalkan')
                                                <span class="badge bg-dark rounded-pill">Dibatalkan</span>
                                                @break
                                            @default
                                                <span class="badge bg-light text-dark rounded-pill">Unknown</span>
                                        @endswitch
                                    </td>
                                    <td>{{ $item->keterangan }}</td>
                                    <td class="text-center">
                                         <!-- Tombol Edit dengan delay -->
                                         <a href="javascript:void(0);" class="btn {{ $item->is_final ? 'btn-secondary' : 'btn-warning' }} btn-sm mb-2 editMutasiBtn" data-id="{{ $item->id }}">
                                            <i class="fas fa-pencil-alt me-1"></i> Edit
                                        </a>
                                        <br>
                                        @if($item->undangan && $item->undangan->file)
                                            <a href="{{ route('mutasi.show1', ['mutasi' => $item->id, 'action' => 'view']) }}?filename={{ basename($item->undangan->file) }}" target="_blank" class="btn btn-sm btn-info mb-2">
                                                <i class="fas fa-eye"></i> Undangan
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Menambahkan delay untuk tombol Tambah Mutasi
        document.getElementById('tambahMutasiBtn').addEventListener('click', function() {
            var button = this;
            button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...'; // Ubah menjadi loading
            button.setAttribute('disabled', 'true'); // Nonaktifkan tombol

            setTimeout(function() {
                window.location.href = "{{ route('mutasi.create') }}"; // Redirect ke URL tambah mutasi
            }, 1000); // Delay 1 detik
        });

        // Menambahkan delay untuk tombol Edit
        document.querySelectorAll('.editMutasiBtn').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Mencegah navigasi segera

                var originalHTML = button.innerHTML; // Simpan HTML asli
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...'; // Ubah menjadi loading
                button.setAttribute('disabled', 'true'); // Nonaktifkan tombol

                // Delay 1 detik sebelum navigasi
                setTimeout(function() {
                    window.location.href = '{{ url("mutasi") }}/' + button.dataset.id + '/edit'; // Redirect ke URL edit mutasi
                }, 1000); // Delay 1 detik
            });
        });

        // Mengaktifkan kembali tombol jika pengguna tidak jadi pindah halaman
        window.onbeforeunload = function() {
            var tambahButton = document.getElementById('tambahMutasiBtn');
            tambahButton.innerHTML = '<i class="fas fa-plus"></i> Tambah Mutasi';
            tambahButton.removeAttribute('disabled');

            document.querySelectorAll('.editMutasiBtn').forEach(function(button) {
                button.innerHTML = button.innerHTML.includes('Loading...') ? '<i class="fas fa-pencil-alt me-1"></i> Edit' : button.innerHTML; // Set ke Edit jika sedang loading
                button.removeAttribute('disabled');
            });
        };
    </script>
@endsection