<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
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

    public function confirmDelete($service_id)
    {
        $this->confirmingDeletion = $service_id;
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
            Service::find($id)->update(['status'=>'Inactive']);
            session()->flash('success','Service deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }
    
    public function render()
    {
        $services = Service::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Active')->paginate($this->page);
        return view('livewire.service.index',['services'=>$services]);
    }
}
