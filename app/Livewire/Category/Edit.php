<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    public $name;
    public $type;
    public $category;

    protected function rules()
    {
        return [
            'name' => 'required',
            'type' => 'required',
        ];
    }
    


    public function mount()
    {
        $this->category = Category::whereSlug($this->slug)->first();
        $this->name = $this->category->name;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('CAT'.'-'.$this->name.'-'.now());
        $this->category->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('categories')->with('message','Category updated successfully.');
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}
