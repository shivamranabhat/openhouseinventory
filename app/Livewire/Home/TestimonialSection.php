<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;
use App\Models\Testimonial;

class TestimonialSection extends Component
{
    public function render()
    {
        $content = Content::where('position','Testimonial')->where('status','Active')->first();
        $testimonials = Testimonial::where('status','Active')->where('status','Active')->latest()->get();
        return view('livewire.home.testimonial-section',compact('testimonials','content'));
    }
}
