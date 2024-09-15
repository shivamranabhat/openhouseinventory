<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=1;

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function remove($slug)
    {
        dd('Hello');
        // $department = Department::whereSlug($slug)->first();
        // dd($department);
        // $department->delete();
        // session()->flash('success','Department deleted successfully');
    }

    public function render()
    {
        $vendors = Vendor::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('pan_vat', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('contact_person', 'like', '%' . $this->search . '%');
        })->paginate($this->page);
        return view('livewire.vendor.index',['vendors'=>$vendors]);
    }
}
