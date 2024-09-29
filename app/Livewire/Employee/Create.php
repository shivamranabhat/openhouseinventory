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
    public $name;
    public $age;
    public $address;
    public $salary;
    public $join_date;
    public $department_id;
    public $designation;
    public $doc_img;
  
    protected function rules()
    {
        return [
            'name' => 'required|unique:employees,name,NULL,id,department_id,' . $this->department_id . ',company_id,' . auth()->user()->company_id,
            'age' => 'required|numeric',
            'address' => 'required',
            'salary' => 'required',
            'join_date' => 'required',
            'department_id' => 'required',
            'designation' => 'required',
            'doc_img' => 'required|image|max:1024',
        ];
    }


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
        $company_id = auth()->user()->company_id;
        Employee::create($validated+['company_id'=>$company_id,'slug'=>$slug]);
        session()->flash('success','Employee added successfully');
        $this->reset();
    }

    public function render()
    {
        $departments = Department::select('id','name')->get();
        return view('livewire.employee.create',compact('departments'));
    }
}
