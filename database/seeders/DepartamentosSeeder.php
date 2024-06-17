<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartamentosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nombre' => 'Ahuachapan',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Santa Ana',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:10:01',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Sonsonate',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:11:12',
                'updated_at' => '2024-02-03 22:12:35',
            ],
            [
                'nombre' => 'Chalatenango',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:11:47',
                'updated_at' => '2024-02-03 22:12:36',
            ],
            [
                'nombre' => 'La Libertad',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:10:36',
                'updated_at' => '2024-02-03 22:12:36',
            ],
            [
                'nombre' => 'San Salvador',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:09:13',
                'updated_at' => '2024-02-03 22:12:37',
            ],
            [
                'nombre' => 'Cuscatlan',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:11:56',
                'updated_at' => '2024-02-03 22:12:37',
            ],
            [
                'nombre' => 'La Paz',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:11:36',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'Cabañas',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:12:28',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'San Vicente',
                'pais_id' => 1,
             
                'created_at' => '2024-02-03 22:12:22',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'Usulutan',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:10:59',
                'updated_at' => '2024-02-03 22:12:39',
            ],
            [
                'nombre' => 'San Miguel',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:10:20',
                'updated_at' => '2024-02-03 22:12:39',
            ],
            [
                'nombre' => 'Morazan',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:12:14',
                'updated_at' => '2024-02-03 22:12:40',
            ],
            [
                'nombre' => 'La Union',
                'pais_id' => 1,
            
                'created_at' => '2024-02-03 22:11:26',
                'updated_at' => '2024-02-03 22:12:40',
            ],
        ];

        DB::table('departamentos')->insert($data);
    }
}
