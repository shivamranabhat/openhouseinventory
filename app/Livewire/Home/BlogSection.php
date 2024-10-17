<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Blog;
use App\Models\Content;

class BlogSection extends Component
{
    public function render()
    {
        $content = Content::where('position','Blog')->where('status','Active')->first();
        $blogs = Blog::select('title','author','image','image_alt','slug','created_at')->where('status','Active')->latest()->take(3)->get();
        return view('livewire.home.blog-section',compact('blogs','content'));
    }
}
