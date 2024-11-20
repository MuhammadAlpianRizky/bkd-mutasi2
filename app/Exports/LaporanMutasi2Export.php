<?php

namespace App\Exports;

use App\Models\Mutasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class LaporanMutasi2Export implements FromCollection, WithHeadings, WithColumnFormatting
{
    protected $mutasi;

    public function __construct($mutasi)
    {
        $this->mutasi = $mutasi;
    }

    public function collection()
    {
        return $this->mutasi->map(function ($item) {
            return [
                $item->nama,
                "'".(string) $item->nip,            // Menambahkan tanda ' sebelum NIP
                "'".(string) $item->no_registrasi,  // Menambahkan tanda ' sebelum No Registrasi
                $item->status,
                $item->pgol,
                $item->jabatan,
                $item->unit_kerja,
                $item->instansi,
                $item->no_hp,
                \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y'), // Format tanggal
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIP',
            'No Registrasi',
            'Status',
            'Pangkat/Gol. Ruang',
            'Jabatan',
            'Unit Kerja',
            'Instansi',
            'No HP',
            'Tanggal Mutasi',
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,  // Kolom NIP sebagai teks
            'C' => NumberFormat::FORMAT_TEXT,  // Kolom No Registrasi sebagai teks
        ];
    }
}
