<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Edit extends Component
{
    public $slug;
    #[Validate('required')]
    public $name;
    #[Validate('required')]
    public $sku;
    #[Validate('nullable')]
    public $quantity;
    #[Validate('required')]
    public $category_id;
    #[Validate('nullable')]
    public $description;
    public $product;
    //public $categories;

    public function mount()
    {
        $this->product = Product::whereSlug($this->slug)->first();
        $this->name = $this->product->name;
        $this->sku = $this->product->sku;
        $this->quantity = $this->product->quantity;
        $this->duration = $this->product->duration;
        $this->category_id = $this->product->category_id;
        $this->description = $this->product->description;
        //$this->categories = Category::select('name','id')->get();
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug($this->name);
        $this->product->update($validated+['slug'=>$slug]);
        sleep(1);
        session()->flash('success','Product updated successfully');
    }

    public function render()
    {
        $categories = Category::select('name','id')->get();
        return view('livewire.inventory.edit',compact('categories'));
    }
}
