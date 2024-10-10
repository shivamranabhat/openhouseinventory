<?php

namespace App\Livewire\StockOut;

use Livewire\Component;
use App\Models\Stock;
use App\Models\StockOut;
use App\Models\ItemIn;
use App\Models\Department;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
    #[Validate('required')]
    public $stock;
    #[Validate('required')]
    public $item_in_id;
    #[Validate('required')]
    public $department_id;
    public $product_id;
    public $item;


    public function product($value)
    {
        $item = ItemIn::find($value);
        if($item)
        {
            $this->product_id = $item->product_id;
            $product = Stock::where('product_id',$this->product_id)->first();
            $currentStock = $product->stock;
            $requestStock = $this->stock;
            if($currentStock >= $requestStock)
            {
            }
            else{
                session()->flash('stock','Stock:alert! Request quantity is not available');
            }
        }
    }
    public function checkQuantity()
    {
        $product = Stock::where('product_id',$this->product_id)->first();
        if($product)
        {
            $currentStock = $product->stock;
            $requestStock = $this->stock;
            if($currentStock >= $requestStock)
            {
            }
            else{
                session()->flash('stock','Stock:alert! Request quantity is not available');
            }
        }
    }

    public function mount()
    {
        $this->item = StockOut::whereSlug($this->slug)->first();
        $this->item_in_id = $this->item->item_in_id;
        $this->department_id = $this->item->department_id;
        $this->company_id = $this->item->company_id;
        $this->stock = $this->item->quantity;
    }

    public function update()
    {
        $validated = $this->validate();
        $item = ItemIn::find($this->item_in_id);
        sleep(1);
        $stockRecord = Stock::where('product_id', $item->product_id)->first();
        $slug = Str::slug($item->product->name.'-'.now());
        if ($stockRecord) {
            // If stock record exists, update the stock
            if($this->item->quantity > $this->stock)
            {
                $updatedStock = $this->item->quantity - $validated['stock'];
                $stockRecord->update([
                    'stock' => $stockRecord->stock + $updatedStock
                ]);
            }
            else{
                $updatedStock = $validated['stock'] - $this->item->quantity;
                $stockRecord->update([
                    'stock' => $stockRecord->stock - $updatedStock
                ]); 
            }
            $this->item->update(['item_in_id'=>$this->item_in_id,'department_id'=>$this->department_id,'company_id'=>auth()->user()->company_id,'quantity'=>$this->stock,'slug'=>$slug]);
            return redirect()->route('stockOuts')->with('message','Product stock updated successfully.');
        } else {
            session()->flash('error','No stock with the requested product.');
        }

    }

    public function render()
    {
        $stocks = ItemIn::whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('item_ins')
                ->groupBy('product_id');
        })
        ->where('id','<>',$this->item->item_in_id)
        ->get();
        $departments = Department::latest()->select('id','name')->where('status','Active')->get();
        return view('livewire.stock-out.edit',compact('stocks','departments'));
    }
}
