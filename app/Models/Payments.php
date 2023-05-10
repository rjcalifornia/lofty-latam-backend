<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $table = 'payments';

    protected $fillable = [
        'lease_id',
        'receipt_number',
        'payment_type_id',
        'payment_date',
        'month_cancelled',
        'uuid',
        'payment',
        'user_creates',
        'user_modifies',
    ];

    protected $appends = ['month_cancelled_name'];

    public function leaseId()
    {
        return $this->belongsTo(LeaseAgreements::class, 'lease_id');
    }

    public function paymentTypeId()
    {
        return $this->belongsTo(PaymentType::class, 'payment_type_id');
    }

    public function userCreates()
    {
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies()
    {
        return $this->belongsTo(User::class, 'user_modifies');
    }

    protected static function booted()
    {
        static::saving(function ($payment) {
            if (!$payment->receipt_number) {
                $lastReceiptNumber = static::where('lease_id', $payment->lease_id)
                    ->orderBy('receipt_number', 'desc')
                    ->value('receipt_number');

                $counter = $lastReceiptNumber ? $lastReceiptNumber + 1 : 1;
                $payment->receipt_number = $counter;
            }
        });
    }

     /**
     * Get the name of the month based on the month_cancelled value
     *
     * @return string|null
     */
    public function getMonthCancelledNameAttribute()
    {
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre',
        ];
        return ucfirst($months[$this->attributes['month_cancelled']]);
    }

    public function getPaymentAttribute($value)
    {
        return number_format($value, 2);
    }
}
