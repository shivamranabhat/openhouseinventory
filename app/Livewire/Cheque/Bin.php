<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Cheque;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function updateChequeStatus()
    {
        $currentDateTime = Carbon::now('Asia/Kathmandu');
        Cheque::whereRaw("STR_TO_DATE(withdraw_date, '%b %e %Y') <= ?", [$currentDateTime])
            ->where('status', 'Pending')
            ->update(['status' => 'Withdraw']);
    }
    
    public function restore($id)
    {
        if (Gate::allows('action-delete')) {
            Cheque::find($id)->update(['is_deleted'=>'No']);
            session()->flash('success','Cheque restored successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        } 
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
            })
            ->where('is_deleted','Yes')
            ->paginate($this->page);
        return view('livewire.cheque.bin',['cheques'=>$cheques]);
    }
}
