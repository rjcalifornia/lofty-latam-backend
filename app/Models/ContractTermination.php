<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractTermination extends Model
{
    use HasFactory;
    protected $table = 'contract_termination';

    protected $fillable = [
        'tenant_id',
        'lease_id',
        'comments',
        'termination_date',
        'user_creates',
        'user_modifies',
    ];


    protected $casts = [
        'user_creates' => 'integer',
    ];

    public function leaseId()
    {
        return $this->belongsTo(LeaseAgreements::class, 'lease_id');
    }

    public function tenantId()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }

    public function userCreates()
    {
        return $this->belongsTo(User::class, 'user_creates');
    }

    public function userModifies()
    {
        return $this->belongsTo(User::class, 'user_modifies');
    }
}
