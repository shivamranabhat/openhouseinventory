<?php

namespace App\Livewire\Department;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    public $name;
    public $head;
    public $phone;
    public $email;
    public $employee;
    public $department;

    protected function rules()
    {
        return [
            'name' => 'required',
            'head' => 'required',
            'phone' => 'required|max:10',
            'email' => 'nullable|email',
            'employee' => 'nullable',
        ];
    }
    protected function messages()
    {
        return [
            'name.unique' => 'The department name ":input" already exists. Please choose another name.',
        ];
    }

    public function mount()
    {
        $this->department = Department::whereSlug($this->slug)->first();
        $this->name = $this->department->name;
        $this->head = $this->department->head;
        $this->phone = $this->department->phone;
        $this->email = $this->department->email;
        $this->employee = $this->department->employee;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('DEP'.'-'.$this->name.'-'.now());
        $this->department->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('departments')->with('success','Department updated successfully.');
    }

    public function render()
    {
        return view('livewire.department.edit');
    }
}
