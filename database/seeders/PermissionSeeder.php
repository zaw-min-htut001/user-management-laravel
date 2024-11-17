<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $crudOperations = ['create', 'read', 'update', 'delete'];
        $features = Feature::all();

        foreach ($features as $feature) {
            foreach ($crudOperations as $operation) {
                $permissionName = strtolower($feature->name) . '_' . $operation;
                Permission::firstOrCreate([
                    'name' => $permissionName,
                    'feature_id' => $feature->id,
                ]);
            }
        }
    }
}
