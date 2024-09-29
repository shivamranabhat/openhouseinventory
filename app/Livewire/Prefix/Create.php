<?php

namespace App\Livewire\Prefix;

use Livewire\Component;
use App\Models\Category;
use App\Models\Prefix;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:prefixes')]
    public $prefix;
    #[Validate('required|unique:prefixes')]
    public $category_id;
   
    protected function messages()
    {
        return [
            'prefix.required'=>'Please provide a prefix',
            'category_id.required'=>'Please select a category',
            'prefix.unique' => 'The prefix with ":input" already exists. Please choose another.',
            'category_id.unique' => 'The prefix for this category already exists. Please choose another.',
        ];
    }
    
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->prefix);
        Prefix::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        session()->flash('success','Prefix added successfully');
        $this->reset();
    }

    public function render()
    {
        $categories = Category::select('id','name')->latest()->get();
        return view('livewire.prefix.create',compact('categories'));
    }
}
