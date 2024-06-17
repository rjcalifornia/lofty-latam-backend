<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MunicipiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nombre' => 'San Salvador Norte',
                'active' => true,
                'departamento_id' => 6,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Salvador Oeste',
                'active' => true,
                'departamento_id' => 6,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Salvador Este',
                'active' => true,
                'departamento_id' => 6,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Salvador Centro',
                'active' => true,
                'departamento_id' => 6,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Salvador Sur',
                'active' => true,
                'departamento_id' => 6,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ]
        ];
        
        DB::table('municipios')->insert($data);
    }
}
