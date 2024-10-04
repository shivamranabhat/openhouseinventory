<?php

namespace App\Livewire\Requisition\Decline;

use Livewire\Component;
use App\Models\Requisition;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;
    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }
   
    public function render()
    {
        $requests = Requisition::where(function ($query) {
            $query->where('quantity', 'like', '%' . $this->search . '%')
                  ->orWhereHas('employee', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->where('status','Declined')->latest()->paginate($this->page);
        return view('livewire.requisition.decline.index',compact('requests'));
    }

}
