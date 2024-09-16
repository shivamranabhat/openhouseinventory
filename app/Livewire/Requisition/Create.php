<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Requisition;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\Attributes\On;

class Create extends Component
{
    #[Validate('required')]
    public $quantity;
    #[Validate('required')]
    public $item_in_id;
    // #[Validate('required')]
    // public $employee_id;

    public function save()
    {
        $validated = $this->validate();
        $createdAt = Carbon::now('Asia/Kathmandu');
        sleep(1);
        $slug = Str::slug('REQ'.'-'.$this->quantity.'-'.now());
        Requisition::create($validated+['slug'=>$slug,'employee_id'=>3,'created_at'=>$createdAt]);
        session()->flash('success','Request sent successfully');
        $this->reset();
        $this->dispatch('request-added');
    }

    public function render()
    {
        $stocks = ItemIn::select('id','product_id')->latest()->get();
        return view('livewire.requisition.create',compact('stocks'));
    }
}
