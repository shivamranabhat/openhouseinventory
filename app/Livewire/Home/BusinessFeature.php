<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;
use App\Models\Feature;

class BusinessFeature extends Component
{
    public function render()
    {
        $content = Content::where('position','Business Feature')->where('status','Active')->first();
        $features = Feature::where('type','Business Feature')->where('status','Active')->get();
        return view('livewire.home.business-feature',compact('content','features'));
    }
}
