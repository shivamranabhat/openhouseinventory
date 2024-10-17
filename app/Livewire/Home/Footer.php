<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;

class Footer extends Component
{
    public function render()
    {
        $content = Content::where('position','Footer')->where('status','Active')->first();
        return view('livewire.home.footer',compact('content'));
    }
}
