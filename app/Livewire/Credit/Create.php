<?php

namespace App\Livewire\Credit;

use Livewire\Component;
use App\Models\Credit;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    public $name;
    public $phone;
    public $amount;

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric',
            'amount' => 'required',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $slug = Str::slug('CRE'.'-'.$this->name.'-'.now());
        sleep(1);
        Credit::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('credits')->with('message','Cheque record added successfully');
    }

    public function render()
    {
        return view('livewire.credit.create');
    }
}
