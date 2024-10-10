<?php

namespace App\Livewire\Credit;

use Livewire\Component;
use App\Models\Credit;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $name;
    public $phone;
    public $amount;
    public $slug;
    public $credit; 

    protected function rules()
    {
        return [
            'name' => 'required',
            'phone' => 'required|numeric',
            'amount' => 'required',
        ];
    }

    public function mount()
    {
        $this->credit = Credit::whereSlug($this->slug)->first();
        $this->name = $this->credit->name;
        $this->phone = $this->credit->phone;
        $this->amount = $this->credit->amount;
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('CRE'.'-'.$this->name.'-'.now());
        sleep(1);
        $this->credit->update($validated+['slug'=>$slug]);
        return redirect()->route('credits')->with('message','Customer record updated successfully');
    }

    public function render()
    {
        return view('livewire.credit.edit');
    }
}
