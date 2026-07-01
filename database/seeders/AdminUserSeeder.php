<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@superspeed.net'],
            [
                'name'     => 'Super Admin',
                'email'    => 'admin@superspeed.net',
                'password' => Hash::make('Admin@12345'),
                'phone'    => '01700000000',
                'role'     => 'admin',
                'address'  => 'Dhaka, Bangladesh',
                'status'   => 'active',
            ]
        );
    }
}
