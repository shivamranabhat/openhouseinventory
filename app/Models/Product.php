<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','sku','quantity','category_id','description','slug'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function barcode()
    {
        return $this->hasMany(Category::class);
    }
}
