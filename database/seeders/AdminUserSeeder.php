<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use RuntimeException;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $password = env('ADMIN_PASSWORD');
        $email = env('ADMIN_EMAIL', 'admin@barberhub.admin');

        if (! is_string($password) || $password === '') {
            throw new RuntimeException('Set ADMIN_PASSWORD in your local .env file before seeding the administrator.');
        }

        // Update the existing administrator account when its email changes,
        // rather than creating a duplicate admin user.
        $admin = User::where('role', 'admin')->first() ?? new User();
        $admin->name = env('ADMIN_NAME', 'BarberHub Administrator');
        $admin->email = $email;
        $admin->password = $password;
        $admin->role = 'admin';
        $admin->is_active = true;
        $admin->save();
    }
}
