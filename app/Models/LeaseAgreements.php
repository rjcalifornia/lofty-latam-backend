<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaseAgreements extends Model
{
    use HasFactory;
    protected $table = 'lease_agreements';

    protected $fillable = [
        'scanned_contract',
        'tenant_id',
        'property_id',
        'rent_type_id',
        'payment_date',
        'expiration_date',
        'price',
        'deposit',
        'duration',
        'user_creates',
        'user_modifies'
    ];

    public function tenantId()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }

    public function propertyId()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function rentType()
    {
        return $this->belongsTo(RentTypeCatalog::class, 'rent_type_id');
    }
}
