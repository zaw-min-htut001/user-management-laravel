<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $features = ['User', 'Role', 'Product'];

        foreach ($features as $featureName) {
            Feature::firstOrCreate(['name' => $featureName]);
        }
    }
}
