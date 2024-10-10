<?php

namespace App\Livewire\Vendor;

use Livewire\Component;
use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $phone;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $pan_vat;
    #[Validate('required')]
    public $contact_person;

    protected function messages()
    {
        return [
            'name.unique' => 'The vendor with name ":input" already exists. Please choose another name.',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('VEN'.'-'.$this->name.'-'.now());
        Vendor::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('vendors')->with('message','Vendor created successfully.');
    }

    public function render()
    {
        return view('livewire.vendor.create');
    }
}
