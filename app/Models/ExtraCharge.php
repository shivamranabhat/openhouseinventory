<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraCharge extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','value','slug'
    ];
    public function billProduct()
    {
        return $this->hasMany(BillProduct::class);
    }
}
