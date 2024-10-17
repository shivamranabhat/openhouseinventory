<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\ItemIn;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function restore($id)
    {
        if (Gate::allows('action-delete')) {
            ItemIn::find($id)->update(['is_deleted'=>'No']);
            session()->flash('success','Stock restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
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
        ->where('is_deleted','Yes')
        ->latest()
        ->paginate($this->page); 
        return view('livewire.stock.bin',['stocks'=>$stocks]);
    }
}
