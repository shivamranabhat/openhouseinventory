<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Barcode extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
       'item_in_id',
       'company_id',
        'barcode',
    ];
    public function itemIns()
    {
        return $this->belongsTo(ItemIn::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
