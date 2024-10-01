<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class PaymentOut extends Model
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
       'type',
       'payment_date',
       'cheque_no',
       'image',
       'total',
       'paid',
       'remain',
       'status',
       'slug',
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function cheque()
    {
        return $this->hasOne(Cheque::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
