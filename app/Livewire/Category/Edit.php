<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    #[Validate('required|unique:categories')]
    public $name;
    #[Validate('required')]
    public $type;
    public $category;

    public function mount()
    {
        $this->category = Category::whereSlug($this->slug)->first();
        $this->name = $this->category->name;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->name);
        $this->category->update($validated+['slug'=>$slug]);
        sleep(1);
        session()->flash('success','Category updated successfully');
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}
