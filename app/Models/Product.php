<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Product extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','sku','quantity','category_id','description','company_id','slug'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function barcode()
    {
        return $this->hasMany(Category::class);
    }
    public function billProducts()
    {
        return $this->hasMany(BillProduct::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
