<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Requisition;
use App\Models\ItemIn;
use App\Models\Stock;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Livewire\Attributes\On; 
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;
    

    public $confirmingDeletion = null; 

    public function confirmDelete($prefix_id)
    {
        $this->confirmingDeletion = $prefix_id;
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
        Requisition::find($id)->delete();
        session()->flash('success','Request deleted successfully');
        $this->confirmingDeletion = null;
    }

    public function render()
    {
        if(auth()->user()->can_approve == 'Yes' || auth()->user()->can_decline == 'Yes')
        {
            $requests = Requisition::where(function ($query) {
                $query->where('quantity', 'like', '%' . $this->search . '%')
                      ->orWhereHas('employee', function($query) {
                          $query->where('name', 'like', '%' . $this->search . '%');
                      });
            })->where('status','Pending')->latest()->paginate($this->page);
        }
        else{
            $requests = Requisition::where(function ($query) {
                $query->where('quantity', 'like', '%' . $this->search . '%');
            })->where('employee_id',auth()->user()->employee_id)->latest()->paginate($this->page);
        }
        return view('livewire.requisition.index',compact('requests'));
    }
    public function approve($slug)
    {
        if (Gate::allows('action-approve')) {
            $request = Requisition::whereSlug($slug)->first();
            $requestStock = $request->quantity;
            $item = ItemIn::find($request->item_in_id);
            $product = Stock::where('product_id',$item->product_id)->first();
            if($product->stock >= $requestStock)
            {
                $newStock = $product->stock - $requestStock;
                $product->update(['stock'=>$newStock]);
                $request->update(['status'=>'Approved']);
                $this->dispatch('request-approved');
                session()->flash('success','Request approved successfully');
            }
            else{
                session()->flash('error','Stock Alert! Only '.$product->stock.' left');
            }
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to approve.');
        }

    }
    public function decline($slug)
    {
        if (Gate::allows('action-decline')) 
        {
            $request = Requisition::whereSlug($slug)->first();
            $request->update(['status'=>'Declined']);
            $this->dispatch('request-declined');
            session()->flash('success','Request declined successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to decline.');
        }
    }
    
}
