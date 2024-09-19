<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;
    #[Validate('required|unique:employees')]
    public $name;
    #[Validate('required')]
    public $age;
    #[Validate('required')]
    public $address;
    #[Validate('required')]
    public $salary;
    #[Validate('required')]
    public $join_date;
    #[Validate('required')]
    public $department_id;
    #[Validate('required')]
    public $designation;
    #[Validate('required|image|max:10240')]
    public $doc_img;
  
    protected function messages()
    {
        return [
            'name.unique' => 'The employee name ":input" already exists. Please choose another name.',
        ];
    }
    
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('EMP'.'-'.$this->name);
        if ($this->doc_img) {
            $fileName = $this->doc_img->getClientOriginalName();
            $filePath = $this->doc_img->storeAs('employees', $fileName, 'public');
            $this->doc_img = 'employees/' . $fileName;
            // Add image name to validated data
            $validated['doc_img'] = $filePath;
        }
        Employee::create($validated+['slug'=>$slug]);
        session()->flash('success','Employee added successfully');
        $this->reset();
    }

    public function render()
    {
        $departments = Department::select('id','name')->get();
        return view('livewire.employee.create',compact('departments'));
    }
}
