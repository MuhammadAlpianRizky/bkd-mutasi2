<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSedeer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $admin = User::create([
            'nip' => '123',
            'nama_lengkap' => 'Admin',
            'acc_on' => bcrypt('123'),
            'is_approved' => true, // Admin sudah disetujui
            'status_verifikasi'=>true,
        ]);
        $admin->assignRole('admin');

        $pegawai = User::create([
            'nip' => '1234',
            'nama_lengkap' => 'Pegawai',
            'no_hp' => '0812345678',
            'acc_on' => bcrypt('1234'),
            'is_approved' => true, // Pegawai belum disetujui
        ]);
        $pegawai->assignRole('pegawai');
    }
}
