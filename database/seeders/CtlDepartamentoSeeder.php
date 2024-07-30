<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CtlDepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('departamentos')->upsert([
            ['id' => 1, 'nombre' => 'Ahuachapán', 'active' => true, 'pais_id' => 1,   ],
            ['id' => 2, 'nombre' => 'Santa Ana', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 3, 'nombre' => 'Sonsonate', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 4, 'nombre' => 'Chalatenango', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 5, 'nombre' => 'La Libertad', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 6, 'nombre' => 'San Salvador', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 7, 'nombre' => 'Cuscatlán', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 8, 'nombre' => 'La Paz', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 9, 'nombre' => 'Cabañas', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 10, 'nombre' => 'San Vicente', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 11, 'nombre' => 'Usulután', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 12, 'nombre' => 'San Miguel', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 13, 'nombre' => 'Morazán', 'active' => true, 'pais_id' => 1,  ],
            ['id' => 14, 'nombre' => 'La Unión', 'active' => true, 'pais_id' => 1,  ],
        ], ['id']);
    }
}
