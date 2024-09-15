<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
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

    public function remove($slug)
    {
       
    }

    public function render()
    {
        $categories = Category::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->paginate($this->page);
        return view('livewire.category.index',['categories'=>$categories]);
    }
}
