<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
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
            Employee::find($id)->update(['status'=>'Active']);
            session()->flash('success','Employee restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }

    public function render()
    {
        $employees = Employee::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.employee.bin',['employees'=>$employees]);
    }
}
