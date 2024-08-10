<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlMunicipioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('municipios')->upsert([
            ['id' => 1, 'nombre' => 'Ahuachapán Norte', 'active' => true, 'departamento_id' => 1],
            ['id' => 2, 'nombre' => 'Ahuachapán Centro', 'active' => true, 'departamento_id' => 1],
            ['id' => 3, 'nombre' => 'Ahuachapán Sur', 'active' => true, 'departamento_id' => 1],
            ['id' => 4, 'nombre' => 'Santa Ana Oeste', 'active' => true, 'departamento_id' => 2],
            ['id' => 5, 'nombre' => 'Santa Ana Este', 'active' => true, 'departamento_id' => 2],
            ['id' => 6, 'nombre' => 'Santa Ana Norte', 'active' => true, 'departamento_id' => 2],
            ['id' => 7, 'nombre' => 'Santa Ana Centro', 'active' => true, 'departamento_id' => 2],
            ['id' => 8, 'nombre' => 'Sonsonate Norte', 'active' => true, 'departamento_id' => 3],
            ['id' => 9, 'nombre' => 'Sonsonate Centro', 'active' => true, 'departamento_id' => 3],
            ['id' => 10, 'nombre' => 'Sonsonate Este', 'active' => true, 'departamento_id' => 3],
            ['id' => 11, 'nombre' => 'Sonsonate Oeste', 'active' => true, 'departamento_id' => 3],
            ['id' => 12, 'nombre' => 'Chalatenango Norte', 'active' => true, 'departamento_id' => 4],
            ['id' => 13, 'nombre' => 'Chalatenango Centro', 'active' => true, 'departamento_id' => 4],
            ['id' => 14, 'nombre' => 'Chalatenango Sur', 'active' => true, 'departamento_id' => 4],
            ['id' => 15, 'nombre' => 'La Libertad Norte', 'active' => true, 'departamento_id' => 5],
            ['id' => 16, 'nombre' => 'La Libertad Centro', 'active' => true, 'departamento_id' => 5],
            ['id' => 17, 'nombre' => 'La Libertad Oeste', 'active' => true, 'departamento_id' => 5],
            ['id' => 18, 'nombre' => 'La Libertad Este', 'active' => true, 'departamento_id' => 5],
            ['id' => 19, 'nombre' => 'La Libertad Costa', 'active' => true, 'departamento_id' => 5],
            ['id' => 20, 'nombre' => 'La Libertad Sur', 'active' => true, 'departamento_id' => 5],
            ['id' => 21, 'nombre' => 'San Salvador Norte', 'active' => true, 'departamento_id' => 6],
            ['id' => 22, 'nombre' => 'San Salvador Oeste', 'active' => true, 'departamento_id' => 6],
            ['id' => 23, 'nombre' => 'San Salvador Este', 'active' => true, 'departamento_id' => 6],
            ['id' => 24, 'nombre' => 'San Salvador Centro', 'active' => true, 'departamento_id' => 6],
            ['id' => 25, 'nombre' => 'San Salvador Sur', 'active' => true, 'departamento_id' => 6],
            ['id' => 26, 'nombre' => 'Cuscatlán Norte', 'active' => true, 'departamento_id' => 7],
            ['id' => 27, 'nombre' => 'Cuscatlán Sur', 'active' => true, 'departamento_id' => 7],
            ['id' => 28, 'nombre' => 'La Paz Este', 'active' => true, 'departamento_id' => 8],
            ['id' => 29, 'nombre' => 'La Paz Centro', 'active' => true, 'departamento_id' => 8],
            ['id' => 30, 'nombre' => 'La Paz Oeste', 'active' => true, 'departamento_id' => 8],
            ['id' => 31, 'nombre' => 'Cabañas Oeste', 'active' => true, 'departamento_id' => 9],
            ['id' => 32, 'nombre' => 'Cabañas Este', 'active' => true, 'departamento_id' => 9],
            ['id' => 33, 'nombre' => 'San Vicente Norte', 'active' => true, 'departamento_id' => 10],
            ['id' => 34, 'nombre' => 'San Vicente Sur', 'active' => true, 'departamento_id' => 10],
            ['id' => 35, 'nombre' => 'Usulután Norte', 'active' => true, 'departamento_id' => 11],
            ['id' => 36, 'nombre' => 'Usulután Este', 'active' => true, 'departamento_id' => 11],
            ['id' => 37, 'nombre' => 'Usulután Oeste', 'active' => true, 'departamento_id' => 11],
            ['id' => 38, 'nombre' => 'San Miguel Norte', 'active' => true, 'departamento_id' => 12],
            ['id' => 39, 'nombre' => 'San Miguel Centro', 'active' => true, 'departamento_id' => 12],
            ['id' => 40, 'nombre' => 'San Miguel Oeste', 'active' => true, 'departamento_id' => 12],
            ['id' => 41, 'nombre' => 'Morazán Norte', 'active' => true, 'departamento_id' => 13],
            ['id' => 42, 'nombre' => 'Morazán Sur', 'active' => true, 'departamento_id' => 13],
            ['id' => 43, 'nombre' => 'La Unión Norte', 'active' => true, 'departamento_id' => 14],
            ['id' => 44, 'nombre' => 'La Unión Sur', 'active' => true, 'departamento_id' => 14],
        ], ['id']);
    }
}
