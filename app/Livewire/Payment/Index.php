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

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function remove($slug)
    {
       
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
        })->paginate($this->page);
        return view('livewire.payment.index',['payments'=>$payments]);
    }
}
