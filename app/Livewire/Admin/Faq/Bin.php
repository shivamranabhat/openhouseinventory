<?php

namespace App\Livewire\Admin\Faq;

use Livewire\Component;
use App\Models\faq;
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
            Faq::find($id)->update(['status'=>'Active']);
            session()->flash('success','Faq restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }

    public function render()
    {
        $faqs = faq::where(function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->latest()->paginate($this->page);
        return view('livewire.admin.faq.bin',['faqs'=>$faqs]);
    }
}
