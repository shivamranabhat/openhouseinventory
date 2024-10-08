<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public $confirmingDeletion = null; 

    public function confirmDelete($user_id)
    {
        $this->confirmingDeletion = $user_id;
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
            User::find($id)->update(['status'=>'Inactive']);
            $this->confirmingDeletion = null;
            session()->flash('success','Account deleted successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }

    public function render()
    {
        $accounts = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->where('email', 'like', '%' . $this->search . '%');
        })->latest()->where('company_id',auth()->user()->company_id)->where('status','Active')->where('id','<>',auth()->user()->id)->where('role','<>','Company')->paginate($this->page);
        return view('livewire.account.index',['accounts'=>$accounts]);
    }
}
