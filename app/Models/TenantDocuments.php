<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDocuments extends Model
{
    use HasFactory;

    protected $table = 'tenant_documents';

    protected $fillable = [
        'document_number',
        'scanned_document',
        'document_type_id',
        'country_id',
        'tenant_id',
        'issuance_date',
        'expiration_date',
        'active',
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

    public function documentTypeId()
    {
        return $this->belongsTo(DocumentTypeCatalog::class, 'document_type_id');
    }

    public function countryId()
    {
        return $this->belongsTo(CountriesCatalog::class, 'country_id');
    }

    public function tenantId()
    {
        return $this->belongsTo(Tenants::class, 'tenant_id');
    }
}
