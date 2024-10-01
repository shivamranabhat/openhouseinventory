<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
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

    public function delete($id)
    {
        Department::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Department deleted successfully');
    }

    public function render()
    {
        $departments = Department::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('head', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('employee', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.department.index',['departments'=>$departments]);
    }
}
