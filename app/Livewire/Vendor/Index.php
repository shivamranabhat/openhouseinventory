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
    public $page=10;

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function delete($id)
    {
        Vendor::find($id)->delete();
        session()->flash('success','Vendor deleted successfully');
    }

    public function render()
    {
        $vendors = Vendor::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('pan_vat', 'like', '%' . $this->search . '%')
                ->orWhere('address', 'like', '%' . $this->search . '%')
                ->orWhere('phone', 'like', '%' . $this->search . '%')
                ->orWhere('contact_person', 'like', '%' . $this->search . '%');
        })->latest()->paginate($this->page);
        return view('livewire.vendor.index',['vendors'=>$vendors]);
    }
}
