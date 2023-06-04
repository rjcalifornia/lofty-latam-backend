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
        'image_name',
        'active',
        'order',
        'user_creates',
        'user_modifies',
    ];

    protected $appends = ['image_link_name'];


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

     /**
     * Get the property picture URL
     *
     * @return string|null
     */
    public function getImageLinkNameAttribute(){

        if($this->attributes['image_name']){
            $id = $this->id;
            return url('/api/v1/property/pictures/' . $id . '/view');
        }else{
            return url('/api/v1/property/pictures/placeholder');
        }
        
        return null;
    }

}
