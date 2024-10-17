<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Company extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','image','slug'
    ];
    public function credits()
    {
        return $this->hasMany(Credit::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
    public function barcodes()
    {
        return $this->hasMany(Barcode::class);
    }
    public function bills()
    {
        return $this->hasMany(Bill::class);
    }
    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }
    public function cheques()
    {
        return $this->hasMany(Cheque::class);
    }
    public function departments()
    {
        return $this->hasMany(Department::class);
    }
    public function extraCharges()
    {
        return $this->hasMany(ExtraCharge::class);
    }
    public function itemIns()
    {
        return $this->hasMany(ItemIn::class);
    }
    public function paymentOuts()
    {
        return $this->hasMany(PaymentOut::class);
    }
    public function prefixes()
    {
        return $this->hasMany(Prefix::class);
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function requisitions()
    {
        return $this->hasMany(Requisition::class);
    }
    public function services()
    {
        return $this->hasMany(Service::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
    public function vendors()
    {
        return $this->hasMany(Vendor::class);
    }
}
