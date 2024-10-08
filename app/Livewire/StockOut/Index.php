<?php

namespace App\Livewire\StockOut;

use Livewire\Component;
use App\Models\StockOut;
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
            StockOut::find($id)->update(['status'=>'Inactive']);
            session()->flash('success','Stock deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }

    public function render()
    {
        $stocks = StockOut::where(function ($query) {
            $query->where('quantity', 'like', '%' . $this->search . '%')
                // Search by product name through ItemIn -> Product relationship
                ->orWhereHas('itemIn.product', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                })
                // Search by department name
                ->orWhereHas('department', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        })
        ->where('status','Active')
        ->latest()
        ->paginate($this->page);
        return view('livewire.stock-out.index',['stocks'=>$stocks]);
    }
}
