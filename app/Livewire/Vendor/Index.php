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
    public $confirmingDeletion = null; 

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }

    public function confirmDelete($vendor_id)
    {
        $this->confirmingDeletion = $vendor_id;
    }
    
    public function cancelDelete()
    {
        $this->confirmingDeletion = null;
    }

    public function delete($id)
    {
        Vendor::find($id)->update(['status'=>'Inactive']);
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
        })->where('status','Active')->latest()->paginate($this->page);
        return view('livewire.vendor.index',['vendors'=>$vendors]);
    }
}
