<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\User;
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
            User::find($id)->update(['status'=>'Active']);
            $this->confirmingDeletion = null;
            session()->flash('success','Account restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }

    public function render()
    {
        $accounts = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->where('email', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->where('company_id',auth()->user()->company_id)->where('id','<>',auth()->user()->id)->where('role','<>','Company')->paginate($this->page);
        return view('livewire.account.bin',['accounts'=>$accounts]);
    }
}
