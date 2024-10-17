<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\ItemIn;
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

    public function confirmDelete($item_in_id)
    {
        $this->confirmingDeletion = $item_in_id;
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
            ItemIn::find($id)->update(['is_deleted'=>'Yes']);
            session()->flash('success','Stock deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
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
        ->where('is_deleted','No')
        ->latest()
        ->paginate($this->page); 
        return view('livewire.stock.index',['stocks'=>$stocks]);
    }
}
