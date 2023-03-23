<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DocumentTypeCatalog;
use DB;
use Carbon\Carbon;

class DocumentTypeCatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $now = Carbon::now();
        $documentType =
        [
            [
                'name' => "DUI",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Pasaporte",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DocumentTypeCatalog::insert($documentType);
    }
}
