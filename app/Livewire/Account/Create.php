<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\Employee;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Create extends Component
{

    public $employee;
    #[Validate('required')]
    public $employee_id;
    
    #[Validate('required|email')]
    public $email;

    #[Validate('required|min:6')]
    public $password;

    #[Validate('required|same:password')]
    public $password_confirmation;

    public $can_create = false;
    public $can_edit = false;
    public $can_delete = false;
    public $can_approve = false;
    public $can_decline = false;

    protected function messages()
    {
        return [
            'employee_id.unique' => 'Account already created for this employee.',
            'employee_id.required' => 'Please choose an employee',
        ];
    }

   
    public function save()
    {
        // Validate and create the user
        $validated = $this->validate();
        User::create([
            'name'=>$this->employee->name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'company_id' => auth()->user()->company_id ? auth()->user()->company_id : '',
            'can_create' => $this->can_create ? 'Yes' : 'No',
            'can_edit' => $this->can_edit ? 'Yes' : 'No',
            'can_delete' => $this->can_delete ? 'Yes' : 'No',
            'can_approve' => $this->can_approve ? 'Yes' : 'No',
            'can_decline' => $this->can_decline ? 'Yes' : 'No',
            'slug'=>$this->employee->slug,
        ]);
        return redirect()->route('accounts')->with('message','Account created successfully.');
    }

    public function render()
    {
        $employees = Employee::select('id','name')->latest()->get();
        return view('livewire.account.create',compact('employees'));
    }
    public function show($value)
    {
        $this->employee_id = $value;
        $this->employee = Employee::find($value);
    }
}
