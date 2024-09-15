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
   
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->name);
        Category::create($validated+['slug'=>$slug]);
        session()->flash('success','Category added successfully');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.category.create');
    }
}
