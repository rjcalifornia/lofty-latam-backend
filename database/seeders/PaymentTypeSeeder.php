<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\PaymentType;
use DB;


class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        $paymentType =
        [
            [
                'name' => "Depósito",
                'activo' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Pago Alquiler",
                'activo' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];
    }
}
