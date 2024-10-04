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
    public $confirmingCategoryDeletion = null; 

    public function confirmDelete($categoryId)
    {
        $this->confirmingCategoryDeletion = $categoryId;
    }

    public function cancelDelete()
    {
        $this->confirmingCategoryDeletion = null;
    }

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Category::find($id)->update(['status'=>'Inactive']);
        $this->confirmingCategoryDeletion = null;
        session()->flash('success','Category deleted successfully');
    }

    public function render()
    {
        $categories = Category::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('type', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.category.index',['categories'=>$categories]);
    }
}
