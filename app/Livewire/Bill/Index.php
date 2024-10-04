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

    public $confirmingDeletion = null; 

    public function confirmDelete($bill_id)
    {
        $this->confirmingDeletion = $bill_id;
    }
    
    public function cancelDelete()
    {
        $this->confirmingDeletion = null;
    }

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Bill::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Bill deleted successfully');
    }

    public function render()
    {
        $bills = Bill::latest()->where('status','Active')->paginate($this->page);
        return view('livewire.bill.index',['bills'=>$bills]);
    }
}
