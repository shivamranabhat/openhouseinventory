<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

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
        Service::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Service deleted successfully');
    }
    
    public function render()
    {
        $services = Service::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Active')->paginate($this->page);
        return view('livewire.service.index',['services'=>$services]);
    }
}
