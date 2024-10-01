<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
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
        Employee::find($id)->delete();
        session()->flash('success','Employee deleted successfully');
    }

    public function render()
    {
        $employees = Employee::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->page);
        return view('livewire.employee.index',['employees'=>$employees]);
    }
}
