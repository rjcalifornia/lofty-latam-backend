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
        'active',
        'user_creates',
        'user_modifies'
    ];

    protected $casts = [
        'active' => 'boolean',
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

    public function payments(){
        return $this->hasMany(Payments::class, 'lease_id')->with(['paymentTypeId'])
        ->withCasts([
            'payment_date' => 'datetime:d/m/Y',
            'created_at' => 'datetime:d/m/Y H:i:s',
            'updated_at' => 'datetime:d/m/Y H:i:s',
            'month_cancelled_name' => 'string',
        ]);
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getDepositAttribute($value)
    {
        return number_format($value, 2);
    }
}
