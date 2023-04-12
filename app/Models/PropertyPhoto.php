<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    use HasFactory;

    protected $table = 'property_photos';

    protected $fillable = [
        'property_id',
        'image',
        'active',
        'order',
        'user_creates',
        'user_modifies',
    ];

    public function userCreates()
    {
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies()
    {
        return $this->belongsTo(User::class, 'user_modifies');
    }

    public function propertyId()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

}
