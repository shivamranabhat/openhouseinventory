<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Requisition;
use App\Models\ItemIn;
use App\Models\Stock;
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
   
    public function render()
    {
        $requests = Requisition::where(function ($query) {
            $query->where('quantity', 'like', '%' . $this->search . '%')
                  ->orWhereHas('employee', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->where('status','Pending')->latest()->paginate($this->page);
        return view('livewire.requisition.index',compact('requests'));
    }
    public function approve($slug)
    {
        $request = Requisition::whereSlug($slug)->first();
        $requestStock = $request->quantity;
        $item = ItemIn::find($request->item_in_id);
        $product = Stock::where('product_id',$item->product_id)->first();
        if($product->stock >= $requestStock)
        {
            $newStock = $product->stock - $requestStock;
            $product->update(['stock'=>$newStock]);
            $request->update(['status'=>'Approved']);
            session()->flash('success','Request approved successfully');
        }
        else{
            session()->flash('error','Stock Alert! Only '.$product->stock.' left');
        }
    }
    public function decline($slug)
    {
        $request = Requisition::whereSlug($slug)->first();
        $request->update(['status'=>'Declined']);
        session()->flash('success','Request declined successfully');
    }
    
}
