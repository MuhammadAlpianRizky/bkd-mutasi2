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
    public function run(): void
    {
        $admin = User::create([
            'nip' => '123',
            'nama_lengkap' => 'Admin',
            'acc_on'=>bcrypt('123')

        ]);
        $admin->assignRole('admin');

        $pegawai = User::create([
            'nip' => '1234',
            'nama_lengkap' => 'Pegawai',
            'acc_on'=>bcrypt('1234')

        ]);
        $pegawai->assignRole('pegawai');
    }
    
}