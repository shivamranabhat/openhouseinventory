<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\On; 

class AuthCard extends Component
{
    public $user;
    public $image;
    public $name;
    #[On('image-removed')] 
    #[On('image-added')] 
    #[On('name-changed')] 
    public function mount()
    {
        $this->user = auth()->user();
        $this->image = $this->user->image;
        $this->name = $this->user->name;
    }
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout successfully');
    }
    public function render()
    {
        return view('livewire.auth.auth-card');
    }
}
