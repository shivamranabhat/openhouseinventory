<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillProduct extends Model
{
    use HasFactory;
    protected $fillable=[
        'bill_id',
        'item_in_id',
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
}
