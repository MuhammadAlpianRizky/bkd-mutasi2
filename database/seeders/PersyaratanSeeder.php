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
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK CPNS',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir Pangkat Terakhir',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK Jabatan Struktural',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK Jabatan Fungsional',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
            [
                'nama_persyaratan' => 'Copy + legalisir SK Jabatan Fungsional',
                'jenis_file' => 'pdf',
                'ukuran' => 1024, // Maksimal 1 MB
            ],
        ]);
    }
}
