<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemIn extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_id',
         'barcode_id',
         'vendor_id',
         'stock',
         'unit_price',
         'total', 
         'purchase_date', 
         'rack_no', 
         'slug', 
     ];
     public function barcode()
     {
        return $this->belongsTo(Barcode::class);
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
