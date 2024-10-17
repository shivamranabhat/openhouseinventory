<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    protected $fillable=[
        'tag_name','title','meta_description','meta_keywords','canonical_tag','page_id','status','slug'
    ];
  
    //Relation with page
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
