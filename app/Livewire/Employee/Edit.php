<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $name;
    public $age;
    public $address;
    public $salary;
    public $join_date;
    public $department_id;
    public $designation;
    public $doc_img;
    #[Validate('nullable|image|max:1024')]
    public $new_doc_img;
    public $employee;

    
    
    public function mount()
    {
        $this->employee = Employee::whereSlug($this->slug)->first();
        $this->name = $this->employee->name;
        $this->age = $this->employee->age;
        $this->address = $this->employee->address;
        $this->salary = $this->employee->salary;
        $this->join_date = $this->employee->join_date;
        $this->department_id = $this->employee->department_id;
        $this->designation = $this->employee->designation;
        $this->doc_img = $this->employee->doc_img;
    }

    protected function rules()
    {
        return [
            'name' => 'required',
            'age' => 'required|numeric',
            'address' => 'required',
            'salary' => 'required',
            'join_date' => 'required',
            'department_id' => 'nullable',
            'designation' => 'required',
        ];
    }
    

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('EMP'.'-'.$this->name.'-'.now());
        if($this->new_doc_img)
        {
            $this->updateImage();
        }
        $this->employee->update([
            'name' => $this->name,
            'age' => $this->age,
            'address' => $this->address,
            'salary' => $this->salary,
            'join_date' => $this->join_date,
            'department_id' => $this->department_id,
            'designation' => $this->designation,
            'doc_img' => $this->doc_img ? $this->doc_img : $this->new_doc_img,
            'slug' => $slug,
        ]);
        sleep(1);
        return redirect()->route('employees')->with('message','Employee updated successfully.');
    }

    public function updateImage()
    {
        if ($this->new_doc_img) 
        {
            $fileName = $this->new_doc_img->getClientOriginalName();
            $companyName = preg_replace('/[^A-Za-z0-9\-]/', '_', auth()->user()->company->name);
            $folderPath = 'employees/' . $companyName;
            $filePath = $this->new_doc_img->storeAs($folderPath, $fileName, 'public');
            $this->new_doc_img = 'employees/'.$companyName.'/' . $fileName;
            $this->employee->update(['doc_img' => $this->new_doc_img]);
        }
    }

    public function deleteImage()
    {
        if (!empty($this->employee->doc_img)) {
            $image_path = public_path('storage/' . $this->employee->doc_img);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->employee->update(['doc_img' => '']);
            // $this->dispatch('image-deleted');
            $this->mount();
        }
    }

    public function render()
    {
        $departments = Department::select('id','name')->where('status','Active')->get();
        return view('livewire.employee.edit',compact('departments'));
    }
}
