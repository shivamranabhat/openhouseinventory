<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\ItemIn;
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
        $stocks = ItemIn::where(function ($query) {
            $query->where('stock', 'like', '%' . $this->search . '%');
        })->paginate($this->page);
        return view('livewire.stock.index',['stocks'=>$stocks]);
    }
}
