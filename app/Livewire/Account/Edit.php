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
            'slug'=>$this->employee->slug,
        ]);
        return redirect()->route('accounts');
        session()->flash('success', 'Account updated successfully.');
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
