<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
    #[Validate('required|unique:products')]
    public $name;
    #[Validate('required')]
    public $sku;
    #[Validate('nullable')]
    public $quantity;
    #[Validate('required')]
    public $category_id;
    #[Validate('nullable')]
    public $description;

    
    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug($this->name);
        Product::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        session()->flash('success','Product added successfully');
        $this->reset();
    }

    public function render()
    {
        $categories = Category::select('name','id')->get();
        return view('livewire.inventory.create',compact('categories'));
    }
}
