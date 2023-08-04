<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class LeaseAgreements extends Model
{
    use HasFactory;
    protected $table = 'lease_agreements';

    protected $fillable = [
        'scanned_contract',
        'tenant_id',
        'property_id',
        'rent_type_id',
        'payment_class_id',
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
        'property_id' => 'integer', 
        'rent_type_id' => 'integer', 
        'user_creates' => 'integer', 
        'duration' => 'integer', 
        'payment_day' => 'integer'
    ];

    protected $appends = ['payment_day'];
    public function tenantId()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }

    public function propertyId()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }
    public function paymentClassId()
    {
        return $this->belongsTo(PaymentClass::class, 'payment_class_id');
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
        ])->orderBy('created_at', 'DESC');
    }

    public function getPriceAttribute($value)
    {
        return number_format($value, 2);
    }

    public function getDepositAttribute($value)
    {
        return number_format($value, 2);
    }

    /**
     * Get the payment day
     *
     * @return string|null
     */
    public function getPaymentDayAttribute(){
        $parsePaymentDay = Carbon::parse($this->payment_date);
        $paymentDay = $parsePaymentDay->day;

        return $paymentDay;
    }
}
