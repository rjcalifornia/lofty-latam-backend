<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;

     /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'user_location';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'distrito_id',
        'active',
        'user_creates',
        'user_modifies',
      
    ];
    protected $casts = [
        'active' => 'boolean', 
    ];

    public function userId()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function userCreates()
    {
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies()
    {
        return $this->belongsTo(User::class, 'user_modifies');
    }

    public function distritoId()
    {
        return $this->belongsTo(Distritos::class, 'distrito_id');
    }

}
