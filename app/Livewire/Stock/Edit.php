<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ItemIn;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
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
    public $item_in;

    public function updatePrice()
    {
        $this->unit_price = $this->unit_price;
        $this->stock = $this->stock;
        $this->total = $this->unit_price * $this->stock;
    }

    
    public function mount()
    {
        $this->item_in = ItemIn::whereSlug($this->slug)->first();
        $this->product_id = $this->item_in->product_id;
        $this->vendor_id = $this->item_in->vendor_id;
        $this->barcode_id = $this->item_in->barcode_id;
        $this->stock = $this->item_in->stock;
        $this->unit_price = $this->item_in->unit_price;
        $this->total = $this->item_in->total;
        $this->purchase_date = $this->item_in->purchase_date;
        $this->rack_no = $this->item_in->rack_no;
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('STOCK'.'-'.$this->product_id.'-'.$this->stock);
        $this->item_in->update($validated+['slug'=>$slug]);
        sleep(1);
        session()->flash('success','Item stock in updated successfully');
    }

    public function render()
    {
        $vendors = Vendor::select('id','name')->get();
        $products = Product::select('id','name')->get();
        return view('livewire.stock.edit',compact('vendors','products'));
    }
}
