<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\CompanyScope;

class Employee extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new CompanyScope);
    }
    protected $fillable=[
        'name','age','address','salary','join_date','department_id','company_id','designation','doc_img','status','slug'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function requisition()
    {
        return $this->hasMany(Requisition::class);
    }
    public function users()
    {
        return $this->hasOne(User::class);
    }
}
