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

        <form action="{{ route('undangan.store') }}" method="POST" enctype="multipart/form-data" id="undanganForm">
            @csrf

            <!-- Tanggal Filter -->
            <div class="mb-3">
                <label for="startDate" class="form-label">Tanggal Mulai</label>
                <input type="text" id="startDate" class="form-control" placeholder="Pilih Tanggal Mulai">
            </div>
            <div class="mb-3">
                <label for="endDate" class="form-label">Tanggal Akhir</label>
                <input type="text" id="endDate" class="form-control" placeholder="Pilih Tanggal Akhir" onchange="filterMutasi()">
            </div>

            <!-- Daftar Mutasi -->
            <h5>Pilih Pegawai untuk Diundang</h5>
            <div id="mutasiList">
                <!-- Daftar mutasi akan diisi secara dinamis berdasarkan filter -->
            </div>

            <!-- Upload File -->
            <div class="mb-3">
                <label for="file" class="form-label">File PDF</label>
                <input type="file" name="file" id="file" class="form-control" accept=".pdf" required>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit" class="btn btn-primary" id="submitButton" disabled>Simpan Undangan</button>
            <a href="{{ route('undangan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- jQuery UI (Datepicker) -->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />

<script>
    // Initialize datepickers
    $(function() {
        $('#startDate').datepicker({
            dateFormat: 'yy-mm-dd',
            onSelect: function(dateText) {
                var minDate = $('#startDate').datepicker('getDate');
                minDate.setDate(minDate.getDate() + 1);
                $('#endDate').datepicker("option", "minDate", minDate);
            }
        });

        $('#endDate').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

    // Filter Mutasi berdasarkan rentang tanggal
    function filterMutasi() {
        const startDate = $('#startDate').val();
        const endDate = $('#endDate').val();

        if (startDate && endDate) {
            $.ajax({
                url: "{{ route('mutasi.filter') }}",
                type: "GET",
                data: {
                    start_date: startDate,
                    end_date: endDate
                },
                success: function(response) {
                    $('#mutasiList').empty();
                    if (response.length > 0) {
                        response.forEach(function(item) {
                            $('#mutasiList').append(`
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="mutasi_ids[]" value="${item.id}" id="mutasi_${item.id}">
                                    <label class="form-check-label" for="mutasi_${item.id}">
                                        ${item.no_registrasi} - ${item.nama}
                                    </label>
                                </div>
                            `);
                        });
                    } else {
                        $('#mutasiList').append('<p>Tidak ada pegawai untuk tanggal yang dipilih.</p>');
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil data!'
                    });
                }
            });
        } else {
            $('#mutasiList').empty();
        }

        $('#submitButton').prop('disabled', true);
    }
</script>

<!-- SweetAlert CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
