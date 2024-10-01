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

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Service::find($id)->delete();
        session()->flash('success','Service deleted successfully');
    }
    
    public function render()
    {
        $services = Service::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate($this->page);
        return view('livewire.service.index',['services'=>$services]);
    }
}
