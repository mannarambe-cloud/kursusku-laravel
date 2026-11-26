<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(['username' => 'admin'], [
            'name'     => 'Administrator KursusKu',
            'email'    => 'admin@kursusku.test',
            'password' => Hash::make('Admin@123'),
            'role'     => 'admin',
            'status'   => 'aktif',
            'jabatan'  => 'Administrator Sistem',
            'instansi' => 'KursusKu',
        ]);

        User::updateOrCreate(['username' => 'user'], [
            'name'     => 'User Contoh',
            'email'    => 'user@kursusku.test',
            'password' => Hash::make('User@1234'),
            'role'     => 'user',
            'status'   => 'aktif',
        ]);
    }
}