<?php

namespace App\Livewire\Admin\Twitter;

use Livewire\Component;
use App\Models\TwitterCard;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
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

    public function restore($id)
    {
        if (Gate::allows('super-admin')) {
            TwitterCard::find($id)->update(['status'=>'Active']);
            session()->flash('success','Twitter card restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }
    public function render()
    {
        $twitters = TwitterCard::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->where('tag_name', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.admin.twitter.bin',['twitters'=>$twitters]);
    }
}
