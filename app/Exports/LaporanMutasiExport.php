<?php

namespace App\Exports;

use App\Models\Mutasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class LaporanMutasiExport implements FromCollection, WithHeadings, WithStyles
{
    protected $mutasi;
    protected $persyaratan;
    protected $uploads;

    public function __construct($mutasi, $persyaratan, $uploads)
    {
        $this->mutasi = $mutasi;
        $this->persyaratan = $persyaratan;
        $this->uploads = $uploads;
    }

    public function collection()
    {
        $data = [];

        foreach ($this->persyaratan as $persyaratan) {
            $fileExists = $this->uploads->firstWhere('persyaratan_id', $persyaratan->id) ? '✓' : '';
            $fileNotExists = !$fileExists ? '✓' : '';

            $data[] = [
                $this->mutasi->nama,
                $this->mutasi->nip,
                $this->mutasi->pangkat,
                $this->mutasi->jabatan,
                $this->mutasi->unit_kerja,
                $this->mutasi->instansi,
                $this->mutasi->no_hp,
                $persyaratan->nama_persyaratan,
                $fileExists,
                $fileNotExists,
            ];
        }

        return collect($data);
    }

    public function headings(): array
    {
        return [
            'Nama Pegawai',
            'NIP',
            'Pangkat/Gol. Ruang',
            'Jabatan',
            'Unit Kerja',
            'Instansi',
            'No HP',
            'Persyaratan',
            'Ada',
            'Tidak Ada',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Gaya untuk header
        $headerRange = 'A1:J1';
        $sheet->getStyle($headerRange)->getFont()->setBold(true);
        $sheet->getStyle($headerRange)->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFFF00'); // Menambahkan warna kuning
    }
}
