<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\ItemIn;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
   
    public function vendor($value)
    {
        
    }

    public function render()
    {
        $vendors = Vendor::select('name','id')->get();
        return view('livewire.bill.create',compact('vendors'));
    }
}
