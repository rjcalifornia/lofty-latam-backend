<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $table = 'property';

    protected $fillable = [
        'name',
        'address',
        'bedrooms',
        'beds',
        'bathrooms',
        'has_ac',
        'has_kitchen',
        'has_dinning_room',
        'has_sink',
        'has_wifi',
        'has_fridge',
        'has_tv',
        'has_furniture',
        'has_garage',
        'landlord_id',
        'active',
        'property_type_id',
        'user_creates',
        'user_modifies',
    ];

    protected $casts = [
        'has_ac' => 'boolean',
        'has_kitchen' => 'boolean',
        'has_dinning_room' => 'boolean',
        'has_sink' => 'boolean',
        'has_fridge' => 'boolean',
        'has_wifi' => 'boolean',
        'has_tv' => 'boolean',
        'has_furniture' => 'boolean',
        'has_garage' => 'boolean',
        'active' => 'boolean',
    ];

    public function landlordId(){
        return $this->belongsTo(User::class, 'landlord_id');
    }
    
    public function propertyTypeId(){
        return $this->belongsTo(User::class, 'property_type_id');
    }

    public function userCreates(){
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies(){
        return $this->belongsTo(User::class, 'user_modifies');
    }

    public function leases(){
        return $this->hasMany(LeaseAgreements::class, 'property_id')->where('active','=', true);
    }

    public function propertyPictures()
    {
        return $this->belongsTo(PropertyPhoto::class, 'id', 'property_id')->withDefault(['image_link_name' =>  url('/api/v1/property/pictures/placeholder')]);

    }


}
