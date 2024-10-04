<?php

namespace App\Livewire\Prefix;

use Livewire\Component;
use App\Models\Category;
use App\Models\Prefix;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    public $prefix;
    public $category_id;
    public $category_prefix;

    protected function rules()
    {
        return [
            'prefix' => 'required|unique:prefixes,prefix,' . $this->category_prefix->id,
            'category_id' => 'required|unique:prefixes,category_id',
        ];
    }
    
    protected function messages()
    {
        return [
            'prefix.required'=>'Please provide a prefix',
            'category_id.required'=>'Please select a category',
            'prefix.unique' => 'The prefix with ":input" already exists. Please choose another.',
            'category_id.unique' => 'The prefix for this category already exists. Please choose another.',
        ];
    }
    
    public function mount()
    {
        $this->category_prefix = Prefix::whereSlug($this->slug)->first();
        $this->prefix = $this->category_prefix->prefix;
        $this->category_id = $this->category_prefix->category_id;
    }
    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->prefix);
        $this->category_prefix->update($validated+['slug'=>$slug]);
        sleep(1);
        return redirect()->route('prefixes')->with('message','Prefix updated successfully.');
    }

    public function render()
    {
        return view('livewire.prefix.edit');
    }
}
