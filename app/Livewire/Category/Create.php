<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:categories')]
    public $name;
    #[Validate('required')]
    public $type;
   
    protected function messages()
    {
        return [
            'name.unique' => 'The vendor with name ":input" already exists. Please choose another name.',
        ];
    }
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->name);
        Category::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('categories')->with('message','Category created successfully.');
    }

    public function render()
    {
        return view('livewire.category.create');
    }
}
