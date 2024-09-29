<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Requisition;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Create extends Component
{
    #[Validate('required')]
    public $quantity;
    #[Validate('required')]
    public $item_in_id;
    // #[Validate('required')]
    // public $employee_id;

    public function checkQuantity()
    {
        $item = ItemIn::find($this->item_in_id);
        $currentStock = $item->stock;
        $requestStock = $this->quantity;
        if($currentStock >= $requestStock)
        {
        }
        else{
            session()->flash('stock','Stock:alert! Request quantity is not available');
        }
    }
    public function save()
    {
        $validated = $this->validate();
        $createdAt = Carbon::now('Asia/Kathmandu');
        sleep(1);
        $slug = Str::slug('REQ'.'-'.$this->quantity.'-'.now());
        $item = ItemIn::find($this->item_in_id);
        $currentStock = $item->stock;
        $requestStock = $this->quantity;
        if($currentStock >= $requestStock)
        {
            $updatedStock = $currentStock - $requestStock;
            $item->update(['stock'=>$updatedStock]);
            Requisition::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug,'employee_id'=>3,'created_at'=>$createdAt]);
            session()->flash('success','Request sent successfully');
            $this->reset();
        }
        else{
            session()->flash('success','Stock:alert! Request item with ":input" is not available');
        }
    }

    public function render()
    {
        $stocks = ItemIn::select('id','product_id')->latest()->get();
        return view('livewire.requisition.create',compact('stocks'));
    }
}
