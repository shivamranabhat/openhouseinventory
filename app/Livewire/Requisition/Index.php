<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Requisition;
use Livewire\Attributes\Url;
use Livewire\Attributes\On;

class Index extends Component
{
    #[Url] 
    public $search = '';
    #[On('request-added')]
    public function render()
    {
        $requests = Requisition::where(function ($query) {
            $query->where('quantity', 'like', '%' . $this->search . '%')
                  ->orWhereHas('employee', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->latest()->get();
        return view('livewire.requisition.index',compact('requests'));
    }
}
