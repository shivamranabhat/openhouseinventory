<?php

namespace App\Livewire\StockOut;

use Livewire\Component;
use App\Models\Product;
use App\Models\ItemIn;
use App\Models\Stock;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Create extends Component
{
    #[Validate('required')]
    public $stock;
    #[Validate('required')]
    public $product_id;


    public function product($value)
    {
        $this->product_id = $value;
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
    public function checkQuantity()
    {
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

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $stockRecord = Stock::where('product_id', $this->product_id)->first();
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
        } else {

            session()->flash('error','No stock with the requested product.');
        }
        session()->flash('message','Product with ":input" stock out successfully.');
        $this->reset();
    }

    public function render()
    {
        $stocks = Product::latest()->select('id','name')->get();
        return view('livewire.stock-out.create',compact('stocks'));
    }
}
