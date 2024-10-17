<?php

namespace App\Livewire\Admin\Script;

use Livewire\Component;
use App\Models\Script;
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

    public function confirmDelete($id)
    {
        $this->confirmingDeletion = $id;
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
        if (Gate::allows('super-admin')) {
            Script::find($id)->update(['status'=>'Inactive']);
            $this->confirmingDeletion = null;
            session()->flash('success','Script deleted successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }
    public function render()
    {
        $scripts = Script::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('position', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.admin.script.index',['scripts'=>$scripts]);
    }
}
