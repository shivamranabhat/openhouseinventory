<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Validate;

class Signup extends Component
{
    #[Validate('required|unique:users')]
    public $email;
    #[Validate('required|min:6')]
    public $password;

    public function save()
    {
        // Validate the input
        $validatedData = $this->validate();

        // Hash the password before storing it
        $validatedData['password'] = Hash::make($this->password);

        // Create the user with hashed password
        User::create($validatedData);

        // Optionally, redirect or show a success message
        session()->flash('success', 'User registered successfully!');

        // Reset the fields after successful registration
        $this->reset();
    }
    public function render()
    {
        return view('livewire.auth.signup');
    }
}
