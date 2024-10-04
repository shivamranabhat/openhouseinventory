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
            'name' => 'required|unique:categories,name,' . $this->category->id,
            'type' => 'required',
        ];
    }
    
    protected function messages()
    {
        return [
            'name.unique' => 'The vendor with name ":input" already exists. Please choose another name.',
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
        $slug = Str::slug($this->name);
        $this->category->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('categories')->with('message','Category updated successfully.');
    }

    public function render()
    {
        return view('livewire.category.edit');
    }
}
