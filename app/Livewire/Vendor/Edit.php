<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    public $name;
    public $phone;
    public $address;
    public $pan_vat;
    public $contact_person;
    public $vendor;

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric|max:10',
            'address' => 'required',
            'pan_vat' => 'required',
            'contact_person' => 'required',
        ];
    }
    
    protected function messages()
    {
        return [
            'name.unique' => 'The vendor with name ":input" already exists. Please choose another name.',
        ];
    }

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
        $slug = Str::slug('VEN'.'-'.$this->name.'-'.now());
        $this->vendor->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('vendors')->with('message','Vendor updated successfully.');
    }

    public function render()
    {
        return view('livewire.vendor.edit');
    }
}
