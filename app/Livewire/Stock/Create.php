<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ItemIn;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;


class Create extends Component
{
  
    #[Validate('required')]
    public $product_id;
    #[Validate('required')]
    public $vendor_id;
    #[Validate('nullable')]
    public $barcode_id;
    #[Validate('required')]
    public $stock;
    #[Validate('required')]
    public $unit_price;
    #[Validate('required')]
    public $total;
    #[Validate('required')]
    public $barcode;
    #[Validate('required')]
    public $purchase_date;
    #[Validate('nullable')]
    public $rack_no;
  
    public function updatePrice()
    {
        $this->unit_price = $this->unit_price;
        $this->stock = $this->stock;
        $this->total = $this->unit_price * $this->stock;
    }
    
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('STOCK'.'-'.$this->product_id.'-'.$this->stock);
        ItemIn::create($validated+['slug'=>$slug]);
        session()->flash('success','Item stocked in successfully');
        $this->reset();
    }

    public function render()
    {
        $vendors = Vendor::select('id','name')->get();
        $products = Product::select('id','name')->get();
        return view('livewire.stock.create',compact('vendors','products'));
    }
}
