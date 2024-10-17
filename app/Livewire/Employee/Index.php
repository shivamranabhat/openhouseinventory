<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
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

    public function confirmDelete($employee_id)
    {
        $this->confirmingDeletion = $employee_id;
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
            Employee::find($id)->update(['status'=>'Inactive']);
            session()->flash('success','Employee deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }

    public function render()
    {
        $employees = Employee::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.employee.index',['employees'=>$employees]);
    }
}
