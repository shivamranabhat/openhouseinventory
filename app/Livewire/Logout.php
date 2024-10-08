<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

class Logout extends Component
{
    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success','Logout successfully');
    }
    public function render()
    {
        return view('livewire.logout');
    }
}
