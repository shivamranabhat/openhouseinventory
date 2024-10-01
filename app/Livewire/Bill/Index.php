<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Bill;
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
        $bills = Bill::latest()->where('status','Active')->paginate($this->page);
        return view('livewire.bill.index',['bills'=>$bills]);
    }
}
