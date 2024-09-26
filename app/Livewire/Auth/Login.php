<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $remember = false;

    public function login()
    {
        // Validate the user input
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login with the remember option
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            // Redirect the user after successful login
            return redirect()->route('employees');
        } else {
            // Flash an error message if login fails
            session()->flash('error', 'The provided credentials are incorrect.');
        }
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
