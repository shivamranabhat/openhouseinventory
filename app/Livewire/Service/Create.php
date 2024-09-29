<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:services')]
    public $name;
    #[Validate('required')]
    public $duration;
    #[Validate('required')]
    public $category_id;
    #[Validate('nullable')]
    public $description;

    
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->name);
        Service::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        session()->flash('success','Service added successfully');
        $this->reset();
    }

    public function render()
    {
        $categories = Category::select('name','id')->get();
        return view('livewire.service.create',compact('categories'));
    }
}
