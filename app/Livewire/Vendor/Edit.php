<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    #[Validate('required|unique:vendors')]
    public $name;
    #[Validate('required|max:10')]
    public $phone;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $pan_vat;
    #[Validate('required')]
    public $contact_person;
    public $vendor;

    public function mount()
    {
        $this->vendor = Vendor::whereSlug($this->slug)->first();
        $this->name = $this->vendor->name;
        $this->phone = $this->vendor->phone;
        $this->address = $this->vendor->address;
        $this->pan_vat = $this->vendor->pan_vat;
        $this->contact_person = $this->vendor->contact_person;
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('VEN'.'-'.$this->name);
        $this->vendor->update($validated+['slug'=>$slug]);
        sleep(1);
        session()->flash('success','Vendor updated successfully');
    }

    public function render()
    {
        return view('livewire.vendor.edit');
    }
}
