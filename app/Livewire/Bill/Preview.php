<?php

namespace App\Livewire\Bill;

use Livewire\Component;

class Preview extends Component
{

    public $slug;
    public function render()
    {
      
        return view('livewire.bill.preview');
    }
}
