<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $permissions = Permission::all();

        if ($adminRole) {
            foreach ($permissions as $permission) {
                $adminRole->permissions()->syncWithoutDetaching($permission->id);
            }
        }
    }
}
