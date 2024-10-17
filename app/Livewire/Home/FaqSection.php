<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Faq;
use App\Models\Content;

class FaqSection extends Component
{
    public function render()
    {
        $content = Content::where('position','FAQs')->where('status','Active')->first();
        $faqs = Faq::where('status','Active')->latest()->get();
        return view('livewire.home.faq-section',compact('faqs','content'));
    }
}
