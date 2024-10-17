<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Script extends Model
{
    use HasFactory;
    protected $fillable=[
        'title','position','code','page_id','status','slug'
    ];
   
    //Relation with page
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
