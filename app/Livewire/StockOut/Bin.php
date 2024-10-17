<?php

namespace App\Livewire\StockOut;

use Livewire\Component;
use App\Models\StockOut;
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
            StockOut::find($id)->update(['status'=>'Active']);
            session()->flash('success','Stock restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
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
        ->where('status','Inactive')
        ->latest()
        ->paginate($this->page);
        return view('livewire.stock-out.bin',['stocks'=>$stocks]);
    }
}
