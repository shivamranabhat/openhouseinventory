<?php

namespace App\Livewire\Credit;

use Livewire\Component;
use App\Models\Credit;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Carbon\Carbon;
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
            Credit::find($id)->update(['status'=>'Active']);
            session()->flash('success','Customer credit restored successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        } 
    }

    public function render()
    {
        $credits = Credit::latest()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->where('status','Inactive')
            ->paginate($this->page);
        return view('livewire.credit.bin',['credits'=>$credits]);
    }
}
