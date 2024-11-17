<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();

        if ($adminRole) {
            User::firstOrCreate([
                'username' => 'admin',
                'email' => 'admin@example.com',
            ], [
                'name' => 'Admin User',
                'role_id' => $adminRole->id,
                'phone' => '1234567890',
                'address' => '123 Admin St, City, Country',
                'is_active' => 1,
                'gender' => 'Male',
                'password' => Hash::make('admin123'),
            ]);
        }
    }
}
