<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;

class Hero extends Component
{
    public function render()
    {
        $content = Content::where('position','Hero Section')->where('status','Active')->first();
        return view('livewire.home.hero',compact('content'));
    }
}
