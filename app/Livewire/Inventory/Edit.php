<?php

namespace App\Livewire\Inventory;

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
        sleep(1.2);
        $slug = Str::slug('PR'.'-'.$this->name.'-'.now());
        $this->product->update($validated+['slug'=>$slug]);
        return redirect()->route('inventories')->with('message','Product updated successfully.');
    }

    public function render()
    {
        $categories = Category::select('name','id')->where('status','Active')->where('type','Product')->get();
        return view('livewire.inventory.edit',compact('categories'));
    }
}
