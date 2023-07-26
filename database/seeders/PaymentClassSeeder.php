<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\PaymentClass;

class PaymentClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $now = Carbon::now();
        $paymentClass =
        [
            [
                'name' => "Mes a mes",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'name' => "Pago por adelantado",
                'active' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        PaymentClass::insert($paymentClass);
    }
}
