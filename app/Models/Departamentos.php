<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    use HasFactory;

    protected $table = 'departamentos';

    protected $fillable = [
        'nombre',
        'pais_id',
        'active',
    ];

    protected $casts = [
        'pais_id'  => 'integer',
        'active' => 'boolean', 
    ];

}
