<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Cheque;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Carbon\Carbon;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function updateChequeStatus()
    {
        $currentDateTime = Carbon::now('Asia/Kathmandu');
        Cheque::where('withdraw_date', '<=', $currentDateTime)
            ->where('status', 'Pending')
            ->update(['status' => 'Withdraw']);
    }

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Cheque::find($id)->delete();
        session()->flash('success','Cheque deleted successfully');
    }

    public function render()
    {
        $this->updateChequeStatus();
        $cheques = Cheque::latest()
            ->where(function ($query) {
                $query->where('status', 'like', '%' . $this->search . '%')
                    ->orWhere('withdraw_date', 'like', '%' . $this->search . '%')
                    ->orWhere('pay_date', 'like', '%' . $this->search . '%')
                    ->orWhereHas('vendor', function($query) {
                        $query->where('name', 'like', '%' . $this->search . '%');
                    });
            })->paginate($this->page);
        return view('livewire.cheque.index',['cheques'=>$cheques]);
    }
}
