<?php

namespace App\Exports;

use App\Models\Mutasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanMutasi2Export implements FromCollection, WithHeadings
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
                $item->nip,
                $item->no_registrasi, // Pastikan field ini ada di model
                $item->status,        // Pastikan field ini ada di model
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
}
