<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\Requisition;
use Illuminate\Support\Facades\Gate;

class Notification extends Component
{
    public function decline($id)
    {
        if (Gate::allows('action-decline')) 
        {
            $request = Requisition::find($id)->update(['status'=>'Declined']);
            $this->dispatch('request-declined');
            session()->flash('success','Request declined successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to decline.');
        }
    }
   
    public function render()
    {
        if(auth()->user()->can_approve=='Yes' && auth()->user()->can_decline =='Yes')
        {
            $requests = Requisition::where('status', 'pending')->latest()->take(5)->get();
            return view('livewire.requisition.notification',compact('requests'));
        }
        else{
            $approved = Requisition::where('status','Approved')->where('employee_id',auth()->user()->employee_id)->latest()->take(5)->get();
            $declined = Requisition::where('status','Declined')->where('employee_id',auth()->user()->employee_id)->latest()->take(5)->get();
            return view('livewire.requisition.notification',compact('approved','declined'));
        }

    }
}
