<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemService extends Model
{
    use HasFactory;
    protected $fillable=[
        'title',
        'description',
        'type',
        'status',
        'slug',
    ];
}
