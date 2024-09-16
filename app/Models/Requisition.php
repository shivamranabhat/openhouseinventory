<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    use HasFactory;
    protected $fillable=[
        'employee_id',
        'item_in_id',
        'quantity',
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
}
