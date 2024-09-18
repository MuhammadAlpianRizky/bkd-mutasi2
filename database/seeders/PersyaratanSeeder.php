<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         DB::table('persyaratan')->insert([
            [
                'nama_persyaratan' => 'Copy + legalisir SK CPNS',
                'kode_persyaratan'=> 'SKCPNS',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK PNS',
                'kode_persyaratan' => 'SKPNS',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir Pangkat Terakhir',
                'kode_persyaratan' => 'PANGKAT',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK Jabatan Struktural',
                'kode_persyaratan'=> 'STURUKTURAL',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK Jabatan Fungsional',
                'kode_persyaratan'=> 'fungsional',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
        ]);
    }
}
