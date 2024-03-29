<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


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
        'bedrooms' => 'integer', 
        'beds' => 'integer', 
        'bathrooms' => 'integer', 
        'property_type_id' => 'integer', 
        'user_creates' => 'integer', 
        'user_modifies' => 'integer', 
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
        return $this->hasMany(LeaseAgreements::class, 'property_id')->orderBy('active', 'DESC');
    }

    public function propertyPictures()
    {
        return $this->belongsTo(PropertyPhoto::class, 'id', 'property_id')
        ->withDefault(
            [   'id' => 1,
                'image_name'=> "placeholder",
                'property_id' =>1,
                'active' => 1,
                'order' => null,
                'user_creates' => 1,
                'user_modifies' => $this->user_modifies,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]);

    }


}
