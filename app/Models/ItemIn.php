<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemIn extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
         'vendor_id',
         'stock',
         'unit_price',
         'total', 
         'purchase_date', 
         'prefix',
         'rack_no', 
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
}
