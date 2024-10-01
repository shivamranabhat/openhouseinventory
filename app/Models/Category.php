<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Category extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','company_id','type','status','slug'
    ];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function prefix()
    {
        return $this->hasOne(Prefix::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
