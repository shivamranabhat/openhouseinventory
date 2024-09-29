<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class BillProduct extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'bill_id',
        'item_in_id',
        'company_id',
        'product',
        'rate',
        'quantity',
        'extra_charge_id',
    ];
    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }
    public function itemIn()
    {
        return $this->belongsTo(ItemIn::class);
    }
    public function extraCharge()
    {
        return $this->belongsTo(ExtraCharge::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
