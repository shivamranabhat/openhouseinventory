<?php

namespace App\Livewire\Prefix;

use Livewire\Component;
use App\Models\Prefix;
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
            Prefix::find($id)->update(['status'=>'Active']);
            session()->flash('success','Prefix restred successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }
    
    public function render()
    {
        $prefixes = Prefix::where(function ($query) {
            $query->where('prefix', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->where('status','Inactive')
        ->latest()
        ->paginate($this->page);
        return view('livewire.prefix.bin',['prefixes'=>$prefixes]);
    }
}
