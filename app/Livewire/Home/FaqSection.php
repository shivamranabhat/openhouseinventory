<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Faq;

class FaqSection extends Component
{
    public function render()
    {
        $faqs = Faq::where('status','Active')->latest()->get();
        return view('livewire.home.faq-section',compact('faqs'));
    }
}
