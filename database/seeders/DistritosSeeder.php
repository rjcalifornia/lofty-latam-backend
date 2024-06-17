<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [

            [
                'nombre' => 'Aguilares',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 1,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'El Paisnal',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 1,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Guazapa',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 1,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Apopa',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 2,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],

            

            [
                'nombre' => 'Nejapa',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 2,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Ilopango',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 3,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Martin',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 3,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Soyapango',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 3,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Tonacatepeque',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 3,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Ayutuxtepeque',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 4,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Mejicanos',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 4,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Salvador',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 4,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Cuscatancingo',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 4,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Ciudad Delgado',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 4,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Panchimalco',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 5,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Rosario de Mora',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 5,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'San Marcos',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 5,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Santiago Texacuangos',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 5,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Santo Tomas',
                'active' => true,
                'departamento_id' => 6,
                'municipio_id' => 5,
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
        ];
        
        DB::table('distritos')->insert($data);
    }
}
