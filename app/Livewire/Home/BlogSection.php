<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Blog;

class BlogSection extends Component
{
    public function render()
    {
        $blogs = Blog::select('title','author','image','image_alt','slug','created_at')->latest()->take(3)->get();
        return view('livewire.home.blog-section',compact('blogs'));
    }
}
