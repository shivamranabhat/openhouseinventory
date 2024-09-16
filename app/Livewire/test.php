<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Category;
use App\Models\Supplier;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Picqer\Barcode\BarcodeGeneratorHTML;
use Illuminate\Support\Facades\Storage;


class Items extends Component
{
    public $name;
    public $quantity_in_stock;
    public $quantity_unit;
    public $cost_price;
    public $selling_price;
    public $category_id;
    public $supplier_id;
    public $discount;
    public $barcode;
    public $barcodeList = [];

    public function store()
    {
        $formFields = $this->validate([
                'name'=>'required|unique:items,name',
                'quantity_in_stock'=>'required',
                'quantity_unit'=>'required',
                'cost_price'=>'required',
                'selling_price'=>'required',
                'category_id'=>'required',
                'supplier_id'=>'required',
                'discount'=>'required',
            ],
            [
                'name.unique'=>'This item is already exists',
                'supplier_id.required'=>'Please choose a supplier',
                'category_id.required'=>'Please choose a category',
            ]
        );
        $slug = Str::slug($formFields['name']);
        $barcode = mt_rand(1000000000,9999999999);
        $exists = Item::where('barcode',$barcode)->first();
        if($exists)
        {
            $barcode = mt_rand(100000000,999999999);
        }
        
        // Save item with barcode
        Item::create($formFields + [
            'barcode' => $barcode,
            'barcode_path' => $barcodeImagePath,
            'slug' => $slug,
        ]);
        return redirect()->route('items')->with('message','Liqour Item stored successfully');
    }
    public function render()
    {
        $categories = Category::select('id','name')->latest()->get();
        $suppliers = Supplier::select('id','name')->latest()->get();
        return view('livewire.items',compact('categories','suppliers'));
    }
}
