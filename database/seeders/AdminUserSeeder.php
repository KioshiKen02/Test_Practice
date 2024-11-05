<?php
// database/seeders/AdminUserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'AdminAccess@gmail.com',
            'password' => Hash::make(env('ADMIN_PASSWORD', 'default_secure_password')), // Secure password handling
            'is_admin' => true,
        ]);
    }
}
