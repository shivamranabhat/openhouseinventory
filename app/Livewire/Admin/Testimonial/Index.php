<?php

namespace App\Livewire\Admin\Testimonial;

use Livewire\Component;
use App\Models\Testimonial;
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
            Testimonial::find($id)->update(['status'=>'Inactive']);
            $this->confirmingDeletion = null;
            session()->flash('success','Testimonial deleted successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to delete.');
        }
    }

    public function render()
    {
        $testimonials = Testimonial::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
            ->orWhere('role', 'like', '%' . $this->search . '%');
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.admin.testimonial.index',['testimonials'=>$testimonials]);
    }
}
