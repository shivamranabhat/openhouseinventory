<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class ItemIn extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'product_id',
         'vendor_id',
         'company_id',
         'stock',
         'unit_price',
         'total', 
         'purchase_date', 
         'rack_no', 
         'status',
         'slug', 
     ];

     public function barcode()
     {
        return $this->hasMany(Barcode::class);
     }
     public function requisition()
     {
         return $this->hasMany(Requisition::class);
     }
     public function product()
     {
        return $this->belongsTo(Product::class);
     }
     public function vendor()
     {
        return $this->belongsTo(Vendor::class);
     }
     public function billProducts()
     {
         return $this->hasMany(BillProduct::class);
     }
     public function company()
     {
         return $this->belongsTo(Company::class);
     }
}
