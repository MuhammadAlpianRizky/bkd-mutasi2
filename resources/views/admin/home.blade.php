@extends('layouts.app')

@section('content')
<style>
    #userStatusChart {
        width: 100% !important;  /* Ensure the canvas takes full width of its container */
        height: 400px !important; /* Fixed height for the chart */
    }
    .card {
        margin-bottom: 20px; /* Add space between cards */
    }
    .card .form-label {
        font-size: 0.9rem; /* Kecilkan label */
        font-weight: 600;
    }
    .card .form-select-sm {
        font-size: 0.85rem; /* Sesuaikan ukuran dropdown */
    }

        #mutasiChart {
        display: block;
        max-width: 100%; /* Membatasi lebar maksimal agar tidak melebihi container */
        height: auto;    /* Membuat tinggi menyesuaikan dengan proporsi */
        max-height: 300px; /* Tinggi maksimal yang lebih kecil */
        aspect-ratio: 2 / 1; /* Rasio aspek untuk menjaga proporsi */
    }
    .card-title {
        text-align: center; /* Center the title */
        font-weight: bold;
        font-size: 1.25rem;
        margin-bottom: 20px;
    }
</style>

<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Cards Section -->
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $pendingUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">User Pending</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $activeUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Sudah Divalidasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user-check"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card border-end">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $inactiveUsersCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Belum Divalidasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="user-x"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <h2 class="text-dark mb-1 font-weight-medium">{{ $mutasiCount }}</h2>
                                <h6 class="text-muted font-weight-normal mb-0">Pengajuan Mutasi</h6>
                            </div>
                            <div class="ms-auto">
                                <span class="text-muted"><i data-feather="file"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Monthly Mutasi Chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title m-0">Statistik Mutasi Bulanan</h4>
                            <div>
                                <label for="yearSelect" class="form-label me-2 mb-0">Tahun:</label>
                                <select id="yearSelect" class="form-select form-select-sm d-inline-block w-auto" onchange="filterByYear()">
                                    @foreach($availableYears as $year)
                                        <option value="{{ $year }}" {{ $year == $selectedYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <canvas id="mutasiChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- User Statistics Chart -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">User Statistics</h4>
                        <canvas id="userStatusChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    // User Statistics Chart
    var ctxUser = document.getElementById('userStatusChart').getContext('2d');
    new Chart(ctxUser, {
        type: 'pie',
        data: {
            labels: ['Pending Users', 'Divalidasi', 'Belum Divalidasi'],
            datasets: [{
                data: [{{ $pendingUsersCount }}, {{ $activeUsersCount }}, {{ $inactiveUsersCount }}],
                backgroundColor: ['#f39c12', '#2ecc71', '#e74c3c'],
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
        }
    });

    // Mutasi Monthly Chart
    var ctxMutasi = document.getElementById('mutasiChart').getContext('2d');
if (ctxMutasi) {
    new Chart(ctxMutasi, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Pengajuan Mutasi',
                data: @json($monthlyCounts), // Data dinamis
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.2)',
                pointBackgroundColor: '#2980b9',
                pointBorderColor: '#2980b9',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true, // Grafik responsif
            maintainAspectRatio: true, // Mempertahankan rasio aspek
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Pengajuan'
                    },
                    beginAtZero: true,
                    ticks: {
                        callback: function (value, index, values) {
                            return Number.isInteger(value) ? value : ''; // Hanya tampilkan bilangan asli
                        }
                    }
                }
            }
        }
    });
}


    // Filter Year Dropdown
    window.filterByYear = function () {
        var selectedYear = document.getElementById('yearSelect').value;
        window.location.href = `?year=${selectedYear}`;
    };
});

</script>
@endsection
