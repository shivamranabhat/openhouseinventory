<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\PaymentOut;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;
    public $confirmingDeletion = null; 

    public function confirmDelete($payment_id)
    {
        $this->confirmingDeletion = $payment_id;
    }
    
    public function cancelDelete()
    {
        $this->confirmingDeletion = null;
    }

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        PaymentOut::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Payment deleted successfully');
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
        })->where('status','Active')->paginate($this->page);
        return view('livewire.payment.index',['payments'=>$payments]);
    }
}
