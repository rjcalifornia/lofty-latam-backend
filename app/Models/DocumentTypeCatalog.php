<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentTypeCatalog extends Model
{
    use HasFactory;
    
    protected $table = 'document_type_catalog';

    protected $fillable = [
        'name',
        'active',
    ];
}
