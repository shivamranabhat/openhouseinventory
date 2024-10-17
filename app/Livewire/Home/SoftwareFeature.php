<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Content;
use App\Models\Feature;

class SoftwareFeature extends Component
{
    public function render()
    {
        $content = Content::where('position','Software Feature')->where('status','Active')->first();
        $features = Feature::where('type','Software Feature')->where('status','Active')->get();
        return view('livewire.home.software-feature',compact('content','features'));
    }
}
