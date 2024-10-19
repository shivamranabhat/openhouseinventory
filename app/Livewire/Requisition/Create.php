<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Stock;
use App\Models\Requisition;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\Attributes\On; 
use Carbon\Carbon;

class Create extends Component
{
    #[Validate('required')]
    public $quantity;
    #[Validate('required')]
    public $item_in_id;


    public function checkQuantity()
    {
        $item = ItemIn::find($this->item_in_id);
        if($item)
        {
            $product = Stock::where('product_id',$item->product_id)->first();
            $currentStock = $product->stock;
            $requestStock = $this->quantity;
            if($currentStock >= $requestStock)
            {
            }
            else{
                session()->flash('stock','Stock:alert! Request quantity is not available');
            }
        }
    }
    public function save()
    {
        $validated = $this->validate();
        $createdAt = Carbon::now('Asia/Kathmandu');
        sleep(1);
        $slug = Str::slug('REQ'.'-'.$this->quantity.'-'.now());
        $item = ItemIn::find($this->item_in_id);
        $product = Stock::where('product_id',$item->product_id)->first();
        $currentStock = $product->stock;
        $requestStock = $this->quantity;
        if($currentStock >= $requestStock)
        {
            $updatedStock = $currentStock - $requestStock;
            $item->update(['stock'=>$updatedStock]);
            Requisition::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug,'employee_id'=>auth()->user()->employee->id,'created_at'=>$createdAt]);
            return redirect()->route('requisitions')->with('message','Request sent successfully.');
        }
        else{
            session()->flash('success','Stock:alert! Request item with ":input" is not available');
        }
    }

    public function render()
    {
        $stocks = ItemIn::selectRaw('MAX(id) as id, product_id')
                ->groupBy('product_id')
                ->where('is_deleted','No')
                ->latest()
                ->get();
        return view('livewire.requisition.create',compact('stocks'));
    }
}
