<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Vendor;
use App\Models\ItemIn;
use App\Models\PaymentOut;
use Barryvdh\DomPDF\Facade\Pdf;
class Transaction extends Component
{
    use WithPagination;
    public $slug;
    public $vendor;
    public function mount()
    {
        $this->vendor = Vendor::whereSlug($this->slug)->first();
    }


    public function render()
    {
        $purchases = ItemIn::where('vendor_id',$this->vendor->id)->latest()->paginate(10);
        $total = ItemIn::where('vendor_id', $this->vendor->id)
        ->selectRaw('SUM(total) as total_sum')
        ->groupBy('vendor_id')
        ->first();
        $transaction = PaymentOut::where('vendor_id',$this->vendor->id)
        ->selectRaw('SUM(paid) as paid')
        ->groupBy('vendor_id')
        ->first();
        $remain = PaymentOut::where('vendor_id',$this->vendor->id)
        ->selectRaw('SUM(remain) as remain')
        ->groupBy('vendor_id')
        ->first();
        return view('livewire.vendor.transaction',compact('purchases','total','transaction','remain'));
    }
}

