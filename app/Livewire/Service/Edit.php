<?php

namespace App\Livewire\Service;

use Livewire\Component;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $duration;
    #[Validate('required')]
    public $category_id;
    #[Validate('nullable')]
    public $description;
    public $service;

    public function mount()
    {
        $this->service = Service::whereSlug($this->slug)->first();
        $this->name = $this->service->name;
        $this->duration = $this->service->duration;
        $this->category_id = $this->service->category_id;
        $this->description = $this->service->description;
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('SER'.'-'.$this->name.'-'.now());
        $this->service->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('services')->with('message','Service updated successfully.');
    }

    public function render()
    {
        $categories = Category::select('name','id')->where('status','Active')->where('type','Service')->get();
        return view('livewire.service.edit',compact('categories'));
    }
}
