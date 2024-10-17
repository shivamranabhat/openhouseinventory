<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Bill;
use App\Models\BillProduct;

class Preview extends Component
{
    public $slug;
    public function render()
    {
        $details = Bill::whereSlug($this->slug)->where('status','Active')->first();
        $products = BillProduct::where('bill_id',$details->id)->latest()->get();
        $subtotal = $products->sum(function ($product) {
            return $product->rate * $product->quantity;
        });
        return view('livewire.bill.preview',compact('details','products','subtotal'));
    }
}
