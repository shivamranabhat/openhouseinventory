<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Blog;
use Livewire\Attributes\On; 

class BlogDetails extends Component
{
    public $slug;
    public $details;
    public function mount()
    {
        $this->details = Blog::whereSlug($this->slug)->first();
    }
    public function render()
    {
        return view('livewire.home.blog-details');
    }
}
