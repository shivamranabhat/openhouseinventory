<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Vendor extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','phone','address','pan_vat','contact_person','company_id','status','slug'
    ];

     public function itemIns()
     {
        return $this->hasMany(ItemIn::class);
     }
     public function bills()
     {
        return $this->hasMany(Bill::class);
     }
     public function paymentOuts()
     {
        return $this->hasMany(PaymentOut::class);
     }
     public function cheques()
     {
         return $this->hasMany(Cheque::class);
     }
     public function company()
     {
         return $this->belongsTo(Company::class);
     }
}
