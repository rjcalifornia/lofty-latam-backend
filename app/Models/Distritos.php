<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Distritos extends Model
{
    use HasFactory;

    protected $table = 'distritos';

    protected $fillable = [
        'nombre',
        'departamento_id',
        'municipio_id',
        'active',
    ];

    public function municipioId()
    {
        return $this->belongsTo(Municipios::class, 'municipio_id');
    }
    public function departamentoId()
    {
        return $this->belongsTo(Departamentos::class, 'departamento_id');
    }
}
