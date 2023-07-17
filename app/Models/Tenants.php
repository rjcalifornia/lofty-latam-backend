<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenants extends Model
{
    use HasFactory;
    
    protected $table = 'tenants';

    protected $fillable = [
        'name',
        'lastname',
        'username',
        'phone',
        'email',
        'active',
        'user_creates',
        'user_modifies',
    ];
    protected $casts = [
        'active' => 'integer',
        'user_creates' => 'integer', 
    ];

    public function userCreates()
    {
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies()
    {
        return $this->belongsTo(User::class, 'user_modifies');
    }

    /**
     * Get the property picture URL
     *
     * @return string|null
     */
    public function getTenantFullNameAttribute(){

    }
}
