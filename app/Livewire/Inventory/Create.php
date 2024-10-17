<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Create extends Component
{
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

    
    public function save()
    {
        $validated = $this->validate();
        sleep(1.2);
        $slug = Str::slug('PR'.'-'.$this->name.'-'.now());
        Product::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('inventories')->with('success','Product created successfully.');
    }

    public function render()
    {
        $categories = Category::select('name','id')->where('status','Active')->where('type','Product')->get();
        return view('livewire.inventory.create',compact('categories'));
    }
}
