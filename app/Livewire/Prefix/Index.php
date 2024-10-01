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

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Prefix::find($id)->delete();
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
        ->latest()
        ->paginate($this->page);
        return view('livewire.prefix.index',['prefixes'=>$prefixes]);
    }
}
