<?php

namespace App\Livewire\Admin\Script;

use Livewire\Component;
use App\Models\Script;
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
        if (Gate::allows('super-admin')) {
            Script::find($id)->update(['status'=>'Active']);
            $this->confirmingDeletion = null;
            session()->flash('success','Script restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }
    public function render()
    {
        $scripts = Script::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.admin.script.bin',['scripts'=>$scripts]);
    }
}
