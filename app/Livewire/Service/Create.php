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
        $slug = Str::slug('SER'.'-'.$this->name.'-'.now());
        Service::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('inventories')->with('success','Service created successfully.');
    }

    public function render()
    {
        $categories = Category::select('name','id')->where('status','Active')->where('type','Service')->get();
        return view('livewire.service.create',compact('categories'));
    }
}
