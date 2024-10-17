<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TwitterCard extends Model
{
    use HasFactory;
    protected $fillable=[
        'tag_name',
        'site',
        'title',
        'description',
        'image',
        'page_id',
        'summary',
        'status',
        'slug',
    ];
  
    //Relation with page
    public function page()
    {
        return $this->belongsTo(Page::class);
    }
}
