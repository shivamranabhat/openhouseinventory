<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Bill;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

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
        if (Gate::allows('action-delete')) {
            Bill::find($id)->update(['status'=>'Inactive']);
            $this->confirmingDeletion = null;
            session()->flash('success','Bill deleted successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
       
    }

    public function render()
    {
        $bills = Bill::latest()->where('status','Active')->paginate($this->page);
        return view('livewire.bill.index',['bills'=>$bills]);
    }
}
