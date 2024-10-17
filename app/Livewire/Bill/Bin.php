<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Bill;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function restore($id)
    {
        if (Gate::allows('action-delete')) {
            Bill::find($id)->update(['status'=>'Active']);
            $this->confirmingDeletion = null;
            session()->flash('success','Bill restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
       
    }

    public function render()
    {
        $bills = Bill::latest()->where('status','Inactive')->paginate($this->page);
        return view('livewire.bill.bin',['bills'=>$bills]);
    }
}
