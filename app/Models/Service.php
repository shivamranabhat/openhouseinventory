<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Service extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','duration','category_id','description','company_id','status','slug'
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
