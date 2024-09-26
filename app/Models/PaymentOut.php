<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentOut extends Model
{
    use HasFactory;
    protected $fillable=[
       'vendor_id',
       'receipt_no',
       'type',
       'payment_date',
       'cheque_no',
       'image',
       'total',
       'paid',
       'remain',
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
}
