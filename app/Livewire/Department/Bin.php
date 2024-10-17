<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
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

    public function restore($id)
    {
        if (Gate::allows('action-delete')) {
            Department::find($id)->update(['status'=>'Active']);
            session()->flash('success','Department restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }
    
    public function render()
    {
        $departments = Department::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('head', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('employee', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.department.bin',['departments'=>$departments]);
    }

}
