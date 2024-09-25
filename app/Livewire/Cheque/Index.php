<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Cheque;
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
        $cheques = Cheque::where(function ($query) {
            $query->where('status', 'like', '%' . $this->search . '%')
                  ->orWhere('withdraw_date', 'like', '%' . $this->search . '%')
                  ->orWhere('pay_date', 'like', '%' . $this->search . '%')
                  ->orWhereHas('vendor', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->paginate($this->page);
        return view('livewire.cheque.index',['cheques'=>$cheques]);
    }
}
