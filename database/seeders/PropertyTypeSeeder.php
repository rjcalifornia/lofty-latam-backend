<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\PropertyType;
use DB;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $propertyType =
        [
            [
                'name' => "Casa completa",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Habitaciones",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        PropertyType::insert($propertyType);
    }
}
