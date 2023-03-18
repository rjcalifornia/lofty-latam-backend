<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'John',
            'lastname' => 'Doe',
            'email' => 'johndoe@rent.sv',
            'username' => 'jdoe',
            'phone' => '2000-0001',
            'dui' => '00000000-0',
            'id_rol' => 1,
            'is_admin' => true,
            'active' => true,
            'email_verified_at' => null,
            'password' => bcrypt('1234567'),
            ]);
    
    }
}
