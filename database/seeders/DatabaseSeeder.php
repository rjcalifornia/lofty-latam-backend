<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->call(UserSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(PaymentTypeSeeder::class);
        $this->call(DocumentTypeCatalogSeeder::class);
        $this->call(RentTypeCatalogSeeder::class);
        $this->call(PropertyTypeSeeder::class);
        $this->call(PaymentClassSeeder::class);
    }
}
