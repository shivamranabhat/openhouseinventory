<?php

namespace App\Livewire\Charge;

use Livewire\Component;
use App\Models\ExtraCharge;
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
            ExtraCharge::find($id)->update(['status'=>'Active']);
            $this->confirmingDeletion = null;
            session()->flash('success','Category restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }

    public function render()
    {
        $charges = ExtraCharge::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.charge.bin',['charges'=>$charges]);
    }
}
