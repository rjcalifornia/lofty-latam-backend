<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\RentTypeCatalog;
use DB;

class RentTypeCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $rentType =
        [
            [
                'name' => "3 meses",
                'value' => 3,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "6 meses",
                'value' => 6,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "1 año",
                'value' => 12,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "1 año y medio",
                'value' => 18,
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
        RentTypeCatalog::insert($rentType);
    }
}
