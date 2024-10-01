<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Prefix extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'category_id',
        'company_id',
         'prefix', 
         'status',
         'slug', 
     ];

     public function category()
     {
        return $this->belongsTo(Category::class);
     }
     public function company()
     {
         return $this->belongsTo(Company::class);
     }
}
