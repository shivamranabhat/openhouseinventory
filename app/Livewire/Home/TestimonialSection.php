<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Testimonial;

class TestimonialSection extends Component
{
    public function render()
    {
        $testimonials = Testimonial::where('status','Active')->latest()->get();
        return view('livewire.home.testimonial-section',compact('testimonials'));
    }
}
