<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    use HasFactory;

    protected $table = 'municipios';

    protected $fillable = [
        'nombre',
        'departamento_id',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean', 
    ];

    public function departamentoId()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id');
    }
}
