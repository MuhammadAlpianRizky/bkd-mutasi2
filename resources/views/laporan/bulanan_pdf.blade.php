<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 10px;
        }
        h1, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
            word-wrap: break-word; /* Bungkus teks panjang */
            white-space: normal;   /* Izinkan teks turun ke bawah */
        }
        th {
            background-color: #f2f2f2;
        }
        /* Buat halaman menjadi landscape untuk cetak */
        @media print {
            @page {
                size: A4 landscape; /* Mengatur orientasi menjadi landscape */
                margin: 10px;       /* Sesuaikan margin */
            }
            body {
                font-size: 12px;
            }
        }
        /* Untuk scroll horizontal di layar */
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <h1>Laporan Bulanan Mutasi</h1>
    <h3>Bulan: {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') }}</h3>
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>NIP</th>
                    <th>No Registrasi</th>
                    <th>Status</th>
                    <th>Tanggal Mutasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($mutasi as $item)
                <tr>
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->nip }}</td>
                    <td>{{ $item->no_registrasi }}</td>
                    <td>{{ $item->status }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td> 
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
