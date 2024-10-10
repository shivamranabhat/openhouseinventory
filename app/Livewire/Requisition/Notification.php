<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Requisition;
use Livewire\Attributes\On; 

class Notification extends Component
{
    public $requests;
    #[On('request-created')]
    #[On('request-approved')]
    #[On('request-declined')]
    public function mount()
    {
        $this->requests = Requisition::where('status', 'Pending')->latest()->get();
    }
   
    public function render()
    {
        return view('livewire.requisition.notification');
    }
}
