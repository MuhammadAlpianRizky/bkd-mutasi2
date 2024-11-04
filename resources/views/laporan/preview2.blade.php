<!DOCTYPE html>
<html>
<head>
    <title>Laporan Mutasi</title>
    <style>
        .tidakada {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 20px;
            text-align: center;
            border: 1px solid black;
            width: 30px;
        }
        .ada{
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 20px;
            text-align: center;
            width: 30px;
            border: 1px solid black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .pengenal {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        
        .header {
            text-align: center;
            
        }
        .sub-header {
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>
<body>

<div class="header">
    <h2>Daftar Kelengkapan Persyaratan Mutasi ke Lingkungan Pemerintahan Kota Banjarmasin</h2>
    <h4>(Berdasarkan peraturan Badan Kepegawaian Negara Nomor 5 Tahun 2019)</h4>
</div>

<table>
    <tr>
        <th class="pengenal">Nama Pegawai</th>
        <td class="pengenal">{{ $mutasi->nama }}</td>
    </tr>
    <tr>
        <th class="pengenal">NIP</th>
        <td class="pengenal">{{ $mutasi->nip }}</td>
    </tr>
    <tr>
        <th class="pengenal">Pangkat/Gol. Ruang</th>
        <td class="pengenal">{{ $mutasi->pangkat }}</td>
    </tr>
    <tr>
        <th class="pengenal">Jabatan</th>
        <td class="pengenal">{{ $mutasi->jabatan }}</td>
    </tr>
    <tr>
        <th class="pengenal">Unit Kerja</th>
        <td class="pengenal">{{ $mutasi->unit_kerja }}</td>
    </tr>
    <tr>
        <th class="pengenal">Instansi</th>
        <td class="pengenal">{{ $mutasi->instansi }}</td>
    </tr>
    <tr>
        <th class="pengenal">No HP</th>
        <td class="pengenal">{{ $mutasi->no_hp }}</td>
    </tr>
</table>

<br>

<table>
    <thead>
        <tr>
            <th class="pengenal" style="text-align: center">No</th>
            <th class="pengenal" style="text-align: center">Persyaratan</th>
            <th class="pengenal">Ada</th>
            <th class="pengenal">Tidak Ada</th>
        </tr>
    </thead>
    <tbody>
        @foreach($persyaratan as $index => $item)
            <tr>
                <td class="pengenal" style="text-align: center">{{ $index + 1 }}</td>
                <td class="pengenal">{{ $item->nama_persyaratan }}</td>
                <td class="ada">
                    @if($uploads->firstWhere('persyaratan_id', $item->id))
                    ✓
                    @else
                    @endif
                </td>
                <td class="tidakada">
                    @if(!$uploads->firstWhere('persyaratan_id', $item->id))
                    ✓
                    @else
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
