<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:departments')]
    public $name;
    #[Validate('required')]
    public $head;
    #[Validate('required|max:10')]
    public $phone;
    #[Validate('nullable|email')]
    public $email;
    #[Validate('nullable')]
    public $employee;
    protected function messages()
    {
        return [
            'name.unique' => 'The department name ":input" already exists. Please choose another name.',
            'name.required' => 'Please choose a valid department name.',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('DEP'.'-'.$this->name);
        Department::create($validated+['slug'=>$slug]);
        session()->flash('success','Department added successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.department.create');
    }
}
