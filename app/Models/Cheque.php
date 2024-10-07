<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Cheque extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'vendor_id',
        'cheque_no',
        'image',
        'payment_out_id',
        'company_id',
        'pay_date',
        'withdraw_date',
        'status',
        'slug',
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
    public function paymentOut()
    {
        return $this->belongsTo(PaymentOut::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
