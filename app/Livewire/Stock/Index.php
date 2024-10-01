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

    public function delete($id)
    {
        ItemIn::find($id)->delete();
        session()->flash('success','Stock deleted successfully');
    }

    public function render()
    {
        $stocks = ItemIn::where(function ($query) {
            $query->where('stock', 'like', '%' . $this->search . '%')
                  ->orWhereHas('product', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  })->orWhereHas('vendor', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        })
        ->latest()
        ->paginate($this->page); 
        return view('livewire.stock.index',['stocks'=>$stocks]);
    }
}
