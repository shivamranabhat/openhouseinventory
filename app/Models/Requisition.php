<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Requisition extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'employee_id',
        'item_in_id',
        'company_id',
        'quantity',
        'status',
        'slug',
        'created_at'
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
    public function itemIn()
    {
        return $this->belongsTo(ItemIn::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
