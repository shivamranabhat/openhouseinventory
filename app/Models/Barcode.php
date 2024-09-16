<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barcode extends Model
{
    use HasFactory;
    protected $fillable=[
       'item_in_id',
        'barcode',
    ];
    public function itemIns()
    {
        return $this->belongsTo(ItemIn::class);
    }

}
