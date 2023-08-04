<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentClass extends Model
{
    use HasFactory;
    protected $table = 'payment_class';

    protected $fillable = [
        'name',
        'active',
    ];

    protected $casts = [
        'active' => 'integer',
    ];
}
