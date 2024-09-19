<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','phone','address','pan_vat','contact_person','slug'
    ];

     public function itemIns()
     {
        return $this->hasMany(ItemIn::class);
     }
     public function paymentOuts()
     {
        return $this->hasMany(PaymentOut::class);
     }
}
