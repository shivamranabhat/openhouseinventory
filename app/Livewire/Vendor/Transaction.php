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
       
        $transaction = PaymentOut::where('vendor_id',$this->vendor->id)
        ->selectRaw('SUM(paid) as paid')
        ->groupBy('vendor_id')
        ->where('status','Active')
        ->first();
        $subRemain = PaymentOut::where('vendor_id',$this->vendor->id)
        ->selectRaw('SUM(remain) as remain')
        ->groupBy('vendor_id')
        ->where('status','Active')
        ->first();
        $itemRemain = ItemIn::where('vendor_id', $this->vendor->id)
        ->selectRaw('SUM(total) as total_sum')
        ->groupBy('vendor_id')
        ->where('status','Pending')
        ->where('is_deleted','No')
        ->first();
        //$remain = $itemRemain ? (int)$itemRemain->total_sum + (int)$subRemain->remain : $subRemain->remain;
        if($itemRemain)
        {
            $remain = (int)$itemRemain->total_sum + (int)$subRemain->remain;
        }
        elseif($subRemain){
            $remain = $subRemain->remain;
        }
        else{
            $remain= 0;
        }
        return view('livewire.vendor.transaction',compact('purchases','transaction','remain'));
    }
}

