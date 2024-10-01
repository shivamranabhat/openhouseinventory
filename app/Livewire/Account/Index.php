<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\User;
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

    public function delete($id)
    {
        User::find($id)->update(['status'=>'Inactive']);
        session()->flash('success','Account deleted successfully');
    }

    public function render()
    {
        $accounts = User::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->where('email', 'like', '%' . $this->search . '%');
        })->where('status','Active')->where('id','<>',auth()->user()->id)->where('role','<>','Company')->where('company_id',auth()->user()->company_id)->paginate($this->page);
        return view('livewire.account.index',['accounts'=>$accounts]);
    }
}
