<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','age','address','salary','join_date','department_id','designation','doc_img','slug'
    ];
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
