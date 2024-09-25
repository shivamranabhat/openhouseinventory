<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable=[
       'vendor_id',
       'receipt_no',
       'bill_date',
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
}
