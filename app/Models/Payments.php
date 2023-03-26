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
        'payment',
        'user_creates',
        'user_modifies',
    ];

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
}
