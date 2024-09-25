<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    use HasFactory;
    protected $fillable=[
        'vendor_id',
        'pay_date',
        'withdraw_date',
        'status',
        'slug',
    ];
    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
