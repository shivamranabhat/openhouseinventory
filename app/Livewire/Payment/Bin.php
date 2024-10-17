<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\PaymentOut;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;
    
    public function restore($id)
    {
        if (Gate::allows('action-delete')) {
            PaymentOut::find($id)->update(['status'=>'Active']);
            session()->flash('success','Payment restored successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }

    public function render()
    {
        $payments = PaymentOut::latest()->where(function ($query) {
            $query->where('cheque_no', 'like', '%' . $this->search . '%')
                  ->orWhere('type', 'like', '%' . $this->search . '%')
                  ->orWhere('payment_date', 'like', '%' . $this->search . '%')
                  ->orWhereHas('vendor', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->where('status','Inactive')->paginate($this->page);
        return view('livewire.payment.bin',['payments'=>$payments]);
    }
}
