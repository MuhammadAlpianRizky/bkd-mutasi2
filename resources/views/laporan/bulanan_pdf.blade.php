<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Bulanan</title>
    <style>
        /* Tambahkan gaya CSS sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1, h3 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Laporan Bulanan</h1>
    <h3>Bulan: {{ $bulan }}</h3>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIP</th>
                <th>No Registrasi</th> <!-- Ubah sesuai kebutuhan -->
                <th>Status</th>
                <th>Tanggal Mutasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($mutasi as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->nip }}</td>
                <td>{{ $item->no_registrasi }} <!-- Tambahkan field no_reg jika tersedia --></td>
                <td>{{ $item->status }}</td>
                <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}</td> <!-- Format tanggal -->
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
