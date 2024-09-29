<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class ExtraCharge extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','value','company_id','slug'
    ];
    public function billProduct()
    {
        return $this->hasMany(BillProduct::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
