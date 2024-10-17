<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Cheque;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public $confirmingDeletion = null; 

    public function confirmDelete($cheque_id)
    {
        $this->confirmingDeletion = $cheque_id;
    }
    
    public function cancelDelete()
    {
        $this->confirmingDeletion = null;
    }

    public function updateChequeStatus()
    {
        $currentDateTime = Carbon::now('Asia/Kathmandu');
        Cheque::whereRaw("STR_TO_DATE(withdraw_date, '%b %e %Y') <= ?", [$currentDateTime])
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
        if (Gate::allows('action-delete')) {
            Cheque::find($id)->update(['is_deleted'=>'Yes']);
            session()->flash('success','Cheque deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
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
            ->where('is_deleted','No')
            ->paginate($this->page);
        return view('livewire.cheque.index',['cheques'=>$cheques]);
    }
}
