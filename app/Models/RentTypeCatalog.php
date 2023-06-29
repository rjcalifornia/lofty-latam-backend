<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RentTypeCatalog extends Model
{
    use HasFactory;
    protected $table = 'rent_type_catalog';

    protected $fillable = [
        'name',
        'value',
        'active',
    ];

    protected $casts = [
        'active' => 'integer',
        'value' => 'integer',
    ];
}
