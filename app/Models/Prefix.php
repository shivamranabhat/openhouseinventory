<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prefix extends Model
{
    use HasFactory;
    protected $fillable=[
        'category_id',
         'prefix', 
         'slug', 
     ];

     public function category()
     {
        return $this->belongsTo(Category::class);
     }
}
