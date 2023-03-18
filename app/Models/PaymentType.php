<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    use HasFactory;
    protected $table = 'payment_type_catalog';

    protected $fillable = ['name', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];
}
