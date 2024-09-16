<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Product;
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
        dd('Hello');
        // $department = Department::whereSlug($slug)->first();
        // dd($department);
        // $department->delete();
        // session()->flash('success','Department deleted successfully');
    }

    public function render()
    {
        $products = Product::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->paginate($this->page);
        return view('livewire.inventory.index',['products'=>$products]);
    }
}
