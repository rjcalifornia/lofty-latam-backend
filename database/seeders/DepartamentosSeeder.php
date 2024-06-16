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
                'map_json' => '{"arcs":[[45,-44,-21]],"id":"SV.AH","properties":{"alt-name":null,"country":"El Salvador","fips":"ES01","hasc":"SV.AH","hc-a2":"AH","hc-group":"admin1","hc-key":"sv-ah","hc-middle-lat":13.863,"hc-middle-lon":-89.892,"labelrank":"9","latitude":"13.8657","longitude":"-89.9057","name":"Ahuachap\\u00e1n","postal-code":"AH","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345292","woe-label":"Ahuachap\\u00e1n, SV, El Salvador","woe-name":"Ahuachap\\u00e1n","identificador":1},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:12:04',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Santa Ana',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-41,-8,-22,43,44]],"id":"SV.SA","properties":{"alt-name":null,"country":"El Salvador","fips":"ES11","hasc":"SV.SA","hc-a2":"SA","hc-group":"admin1","hc-key":"sv-sa","hc-middle-lat":14.103,"hc-middle-lon":-89.526,"labelrank":"9","latitude":"14.1024","longitude":"-89.5013","name":"Santa Ana","postal-code":"SA","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345302","woe-label":"Santa Ana, SV, El Salvador","woe-name":"Santa Ana","identificador":2},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:10:01',
                'updated_at' => '2024-02-03 22:12:34',
            ],
            [
                'nombre' => 'Sonsonate',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-7,19,20,21]],"id":"SV.SO","properties":{"alt-name":null,"country":"El Salvador","fips":"ES13","hasc":"SV.SO","hc-a2":"SO","hc-group":"admin1","hc-key":"sv-so","hc-middle-lat":13.695,"hc-middle-lon":-89.669,"labelrank":"9","latitude":"13.7165","longitude":"-89.69370000000001","name":"Sonsonate","postal-code":"SO","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345304","woe-label":"Sonsonate, SV, El Salvador","woe-name":"Sonsonate","identificador":3},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:11:12',
                'updated_at' => '2024-02-03 22:12:35',
            ],
            [
                'nombre' => 'Chalatenango',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-17,-23,-9,40,41,42]],"id":"SV.CH","properties":{"alt-name":null,"country":"El Salvador","fips":"ES03","hasc":"SV.CH","hc-a2":"CH","hc-group":"admin1","hc-key":"sv-ch","hc-middle-lat":14.222,"hc-middle-lon":-89.14,"labelrank":"9","latitude":"14.1895","longitude":"-89.0591","name":"Chalatenango","postal-code":"CH","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345294","woe-label":"Chalatenango, SV, El Salvador","woe-name":"Chalatenango","identificador":4},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:11:47',
                'updated_at' => '2024-02-03 22:12:36',
            ],
            [
                'nombre' => 'La Libertad',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[5,6,7,8,9,10]],"id":"SV.LI","properties":{"alt-name":null,"country":"El Salvador","fips":"ES05","hasc":"SV.LI","hc-a2":"LI","hc-group":"admin1","hc-key":"sv-li","hc-middle-lat":13.782,"hc-middle-lon":-89.351,"labelrank":"9","latitude":"13.7727","longitude":"-89.35930000000001","name":"La Libertad","postal-code":"LI","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345296","woe-label":"La Libertad, SV, El Salvador","woe-name":"La Libertad","identificador":5},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:10:36',
                'updated_at' => '2024-02-03 22:12:36',
            ],
            [
                'nombre' => 'San Salvador',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-16,-13,-10,22]],"id":"SV.SS","properties":{"alt-name":null,"country":"El Salvador","fips":"ES10","hasc":"SV.SS","hc-a2":"SS","hc-group":"admin1","hc-key":"sv-ss","hc-middle-lat":13.732,"hc-middle-lon":-89.146,"labelrank":"9","latitude":"13.713","longitude":"-89.14879999999999","name":"San Salvador","postal-code":"SS","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345301","woe-label":"San Salvador, SV, El Salvador","woe-name":"San Salvador","identificador":6},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:09:13',
                'updated_at' => '2024-02-03 22:12:37',
            ],
            [
                'nombre' => 'Cuscatlan',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-14,15,16,17,18]],"id":"SV.CU","properties":{"alt-name":null,"country":"El Salvador","fips":"ES04","hasc":"SV.CU","hc-a2":"CU","hc-group":"admin1","hc-key":"sv-cu","hc-middle-lat":13.833,"hc-middle-lon":-89.021,"labelrank":"9","latitude":"13.8166","longitude":"-89.0055","name":"Cuscatl\\u00e1n","postal-code":"CU","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345295","woe-label":"Cuscatl\\u00e1n, SV, El Salvador","woe-name":"Cuscatl\\u00e1n","identificador":7},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:11:56',
                'updated_at' => '2024-02-03 22:12:37',
            ],
            [
                'nombre' => 'La Paz',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[11,-11,12,13,14]],"id":"SV.PA","properties":{"alt-name":null,"country":"El Salvador","fips":"ES06","hasc":"SV.PA","hc-a2":"PA","hc-group":"admin1","hc-key":"sv-pa","hc-middle-lat":13.494,"hc-middle-lon":-88.974,"labelrank":"9","latitude":"13.4872","longitude":"-88.9628","name":"La Paz","postal-code":"PA","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345297","woe-label":"La Paz, SV, El Salvador","woe-name":"La Paz","identificador":8},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:11:36',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'Cabañas',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[-31,46,36,37,-35,-18,-43,47]],"id":"SV.CA","properties":{"alt-name":null,"country":"El Salvador","fips":"ES02","hasc":"SV.CA","hc-a2":"CA","hc-group":"admin1","hc-key":"sv-ca","hc-middle-lat":13.893,"hc-middle-lon":-88.723,"labelrank":"9","latitude":"13.9079","longitude":"-88.73260000000001","name":"Caba\\u00f1as","postal-code":"CA","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345293","woe-label":"Caba\\u00f1as, SV, El Salvador","woe-name":"Caba\\u00f1as","identificador":9},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:12:28',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'San Vicente',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[[-28,32,33,-15,-19,34,35]],[[36,37,38]]],"id":"SV.SV","properties":{"alt-name":null,"country":"El Salvador","fips":"ES12","hasc":"SV.SV","hc-a2":"SV","hc-group":"admin1","hc-key":"sv-sv","hc-middle-lat":13.663,"hc-middle-lon":-88.712,"labelrank":"9","latitude":"13.6291","longitude":"-88.6917","name":"San Vicente","postal-code":"SV","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345303","woe-label":"San Vicente, SV, El Salvador","woe-name":"San Vicente","identificador":10},"type":"MultiPolygon"}',
                'created_at' => '2024-02-03 22:12:22',
                'updated_at' => '2024-02-03 22:12:38',
            ],
            [
                'nombre' => 'Usulutan',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[39,-33,-27]],"id":"SV.US","properties":{"alt-name":null,"country":"El Salvador","fips":"ES14","hasc":"SV.US","hc-a2":"US","hc-group":"admin1","hc-key":"sv-us","hc-middle-lat":13.438,"hc-middle-lon":-88.535,"labelrank":"9","latitude":"13.4104","longitude":"-88.52930000000001","name":"Usulut\\u00e1n","postal-code":"US","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345305","woe-label":"Usulut\\u00e1n, SV, El Salvador","woe-name":"Usulut\\u00e1n","identificador":11},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:10:59',
                'updated_at' => '2024-02-03 22:12:39',
            ],
            [
                'nombre' => 'San Miguel',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[25,26,27,28,29,30,31,-25,-3]],"id":"SV.SM","properties":{"alt-name":null,"country":"El Salvador","fips":"ES09","hasc":"SV.SM","hc-a2":"SM","hc-group":"admin1","hc-key":"sv-sm","hc-middle-lat":13.448,"hc-middle-lon":-88.208,"labelrank":"9","latitude":"13.4882","longitude":"-88.1953","name":"San Miguel","postal-code":"SM","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345300","woe-label":"San Miguel, SV, El Salvador","woe-name":"San Miguel","identificador":12},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:10:20',
                'updated_at' => '2024-02-03 22:12:39',
            ],
            [
                'nombre' => 'Morazan',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[23,-4,24]],"id":"SV.MO","properties":{"alt-name":null,"country":"El Salvador","fips":"ES08","hasc":"SV.MO","hc-a2":"MO","hc-group":"admin1","hc-key":"sv-mo","hc-middle-lat":13.767,"hc-middle-lon":-88.095,"labelrank":"9","latitude":"13.7736","longitude":"-88.10550000000001","name":"Moraz\\u00e1n","postal-code":"MO","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345299","woe-label":"Moraz\\u00e1n, SV, El Salvador","woe-name":"Moraz\\u00e1n","identificador":13},"type":"Polygon"}',
                'created_at' => '2024-02-03 22:12:14',
                'updated_at' => '2024-02-03 22:12:40',
            ],
            [
                'nombre' => 'La Union',
                'pais_id' => 1,
                'map_json' => '{"arcs":[[[0]],[[1]],[[2,3,4]]],"id":"SV.UN","properties":{"alt-name":null,"country":"El Salvador","fips":"ES07","hasc":"SV.UN","hc-a2":"UN","hc-group":"admin1","hc-key":"sv-un","hc-middle-lat":13.507,"hc-middle-lon":-87.891,"labelrank":"9","latitude":"13.302","longitude":"-87.9301","name":"La Uni\\u00f3n","postal-code":"UN","region":null,"subregion":null,"type":"Departamento","type-en":"Department","woe-id":"2345298","woe-label":"La Uni\\u00f3n, SV, El Salvador","woe-name":"La Uni\\u00f3n","identificador":14},"type":"MultiPolygon"}',
                'created_at' => '2024-02-03 22:11:26',
                'updated_at' => '2024-02-03 22:12:40',
            ],
        ];

        DB::table('departamentos')->insert($data);
    }
}
