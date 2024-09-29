<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
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

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('VEN'.'-'.$this->name);
        Vendor::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        session()->flash('success','Vendor added successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.vendor.create');
    }
}
