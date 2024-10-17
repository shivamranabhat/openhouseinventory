<?php

namespace App\Livewire\Admin\Tag;

use Livewire\Component;
use App\Models\Tag;
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
            Tag::find($id)->update(['status'=>'Inactive']);
            $this->confirmingDeletion = null;
            session()->flash('success','Tag deleted successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }
    public function render()
    {
        $tags = Tag::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%')
            ->where('tag_name', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.admin.tag.index',['tags'=>$tags]);
    }
}
