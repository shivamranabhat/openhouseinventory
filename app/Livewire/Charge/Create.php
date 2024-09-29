<?php

namespace App\Livewire\Charge;

use Livewire\Component;
use App\Models\ExtraCharge;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:extra_charges')]
    public $name;
    #[Validate('required|numeric')]
    public $value;
   
    protected function messages()
    {
        return [
            'name.unique' => 'The charge name ":input" already exists. Please choose another name.',
            'name.required' => 'Please choose a valid name.',
            'value.required' => 'Please choose a valid charge without %.',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->name);
        ExtraCharge::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        session()->flash('success','Charge added successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.charge.create');
    }
}
