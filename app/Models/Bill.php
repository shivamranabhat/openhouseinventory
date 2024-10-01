<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Bill extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
       'vendor_id',
       'company_id',
       'receipt_no',
       'bill_date',
       'status',
       'slug',
    ];
    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
