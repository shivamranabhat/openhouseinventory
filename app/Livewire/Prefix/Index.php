<?php

namespace App\Livewire\Prefix;

use Livewire\Component;
use App\Models\Prefix;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public $confirmingDeletion = null; 

    public function confirmDelete($prefix_id)
    {
        $this->confirmingDeletion = $prefix_id;
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
        Prefix::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Prefix deleted successfully');
    }
    
    public function render()
    {
        $prefixes = Prefix::where(function ($query) {
            $query->where('prefix', 'like', '%' . $this->search . '%')
            ->orWhereHas('category', function($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            });
        })
        ->where('status','Active')
        ->latest()
        ->paginate($this->page);
        return view('livewire.prefix.index',['prefixes'=>$prefixes]);
    }
}
