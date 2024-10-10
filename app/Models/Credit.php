<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Credit extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
       'name',
        'phone',
        'amount',
        'company_id',
        'status',
        'slug',
    ];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
