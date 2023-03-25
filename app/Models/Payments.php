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
}
