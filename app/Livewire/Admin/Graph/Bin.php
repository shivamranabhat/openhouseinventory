<?php

namespace App\Livewire\Admin\Graph;

use Livewire\Component;
use App\Models\OpenGraph;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
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

    public function restore($id)
    {
        if (Gate::allows('super-admin')) {
            OpenGraph::find($id)->update(['status'=>'Active']);
            $this->confirmingDeletion = null;
            session()->flash('success','Open graph restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to restore.');
        }
    }
    public function render()
    {
        $graphs = OpenGraph::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->orWhere('tag_name', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.admin.graph.bin',['graphs'=>$graphs]);
    }
}
