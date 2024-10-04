<?php

namespace App\Livewire\Account;

use Livewire\Component;
use App\Models\User;
use App\Models\Employee;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $slug;
    public $employee;
    public $employee_id;
    public $account;
    public $email;
    public $password;
    public $password_confirmation;
    public $can_create;
    public $can_edit;
    public $can_delete;
    public $can_approve;
    public $can_decline;

    protected function rules()
    {
        return [
            'email' => 'required|unique:users,email,' . $this->account->id,
            'password' => 'nullable|min:6|same:password_confirmation',
        ];
    }

    protected function messages()
    {
        return [
            'employee_id.unique' => 'Account already created for this employee.',
            'employee_id.required' => 'Please choose an employee',
        ];
    }

    public function mount()
    {
        $this->account = User::whereSlug($this->slug)->first();
        $this->name = $this->account->name;
        $this->email = $this->account->email;
        $this->employee_id = $this->account->employee_id;
        $this->employee = Employee::find($this->employee_id);
        $this->can_create = $this->account->can_create==='Yes';
        $this->can_edit = $this->account->can_edit==='Yes';
        $this->can_delete = $this->account->can_delete==='Yes';
        $this->can_approve = $this->account->can_approve==='Yes';
        $this->can_decline = $this->account->can_decline==='Yes';
    }
    public function update()
    {
        $validated = $this->validate();
        $this->account->update([
            'name'=>$this->employee->name,
            'employee_id' => $this->employee_id,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $this->account->password,
            'company_id' => auth()->user()->company_id,
            'can_create' => $this->can_create ? 'Yes' : 'No',
            'can_edit' => $this->can_edit ? 'Yes' : 'No',
            'can_delete' => $this->can_delete ? 'Yes' : 'No',
            'can_approve' => $this->can_approve ? 'Yes' : 'No',
            'can_decline' => $this->can_decline ? 'Yes' : 'No',
            'slug'=>$this->employee->slug,
        ]);
        return redirect()->route('accounts')->with('message','Account updated successfully.');
    }
    public function render()
    {
        $employees = Employee::select('id','name')->latest()->get();
        return view('livewire.account.edit',compact('employees'));
    }
    public function show($value)
    {
        $this->employee_id = $value;
        $this->employee = Employee::find($value);
    }
}
