<?php

namespace App\Livewire\StockOut;

use Livewire\Component;
use App\Models\Product;
use App\Models\Department;
use App\Models\ItemIn;
use App\Models\Stock;
use App\Models\StockOut;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Create extends Component
{
    #[Validate('required')]
    public $stock;
    #[Validate('required')]
    public $item_in_id;
    #[Validate('required')]
    public $department_id;
    public $product_id;


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

    public function save()
    {
        $validated = $this->validate();
        $item = ItemIn::find($this->item_in_id);
        sleep(1);
        $stockRecord = Stock::where('product_id', $item->product_id)->first();
        $slug = Str::slug($item->product->name.'-'.now());
        if ($stockRecord) {
              // If stock record exists, update the stock
            if($this->stock > $stockRecord->stock)
            {
                $stockRecord->update([
                    'stock' => $this->stock - $stockRecord->stock
                ]); 
            }
            else{
                $stockRecord->update([
                    'stock' => $stockRecord->stock - $this->stock
                ]); 
            }
            StockOut::create(['item_in_id'=>$this->item_in_id,'department_id'=>$this->department_id,'company_id'=>auth()->user()->company_id,'quantity'=>$this->stock,'slug'=>$slug]);
            session()->flash('message','Product stock out successfully.');
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
        ->get();
        $departments = Department::latest()->select('id','name')->where('status','Active')->get();
        return view('livewire.stock-out.create',compact('stocks','departments'));
    }
}
