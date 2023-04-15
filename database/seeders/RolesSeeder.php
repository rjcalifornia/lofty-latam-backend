<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Enums\RolesEnum;
use App\Models\Roles;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdminUser = User::where('email', 'johndoe@rent.sv')->firstOrFail();
        $roles = RolesEnum::getRoles();
        $rolesInsert= [];
        $now = Carbon::now();
        foreach ($roles as $rol) {
            $rolesInsert[] = [
                'name' => $rol,
                'active' => true,
                'user_creates' => $superAdminUser->id,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }
        Roles::insert($rolesInsert);

    }
}
