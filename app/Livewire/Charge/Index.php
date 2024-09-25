<?php

namespace App\Livewire\Charge;

use Livewire\Component;
use App\Models\ExtraCharge;
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

    public function remove($slug)
    {
       
    }

    public function render()
    {
        $charges = ExtraCharge::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->page);
        return view('livewire.charge.index',['charges'=>$charges]);
    }
}
