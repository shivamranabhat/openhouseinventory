<?php

namespace App\Livewire\Credit;

use Livewire\Component;
use App\Models\Credit;
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

  

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        if (Gate::allows('action-delete')) {
            Credit::find($id)->update(['status'=>'Inactive']);
            session()->flash('success','Customer credit deleted successfully');
            $this->confirmingDeletion = null;
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        } 
    }

    public function render()
    {
        $credits = Credit::latest()
            ->where(function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->where('status','Active')
            ->paginate($this->page);
        return view('livewire.credit.index',['credits'=>$credits]);
    }
}
