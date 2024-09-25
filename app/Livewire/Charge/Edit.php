<?php

namespace App\Livewire\Charge;

use Livewire\Component;
use App\Models\ExtraCharge;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    public $name;
    public $value;
    public $charge;

    protected function rules()
    {
        return [
            'name' => 'required|unique:extra_charges,name,' . $this->charge->id,
            'value' => 'required|numeric',
        ];
    }

    protected function messages()
    {
        return [
            'name.unique' => 'The charge name ":input" already exists. Please choose another name.',
            'name.required' => 'Please choose a valid name.',
            'value.required' => 'Please choose a valid charge without %.',
        ];
    }

    public function mount()
    {
        $this->charge = ExtraCharge::whereSlug($this->slug)->first();
        $this->name = $this->charge->name;
        $this->value = $this->charge->value;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->name);
        $this->charge->update($validated+['slug'=>$slug]);
        sleep(1);
        session()->flash('success','Charge updated successfully');
    }

    public function render()
    {
        return view('livewire.charge.edit');
    }
}
