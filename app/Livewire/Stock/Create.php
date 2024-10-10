<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\ItemIn;
use App\Models\Stock;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use App\Models\Barcode;
use Illuminate\Support\Facades\DB;

class Create extends Component
{
  
    #[Validate('required')]
    public $product_id;
    #[Validate('required')]
    public $vendor_id;
    #[Validate('nullable')]
    public $barcode_id;
    #[Validate('required')]
    public $stock;
    #[Validate('required')]
    public $unit_price;
    #[Validate('required')]
    public $total;
    public $prefix;
    #[Validate('nullable|numeric|min:1')]
    public $barcode;
    #[Validate('required')]
    public $purchase_date;
    #[Validate('nullable')]
    public $rack_no;
    public $barcodeList = [];
  
    protected function messages()
    {
        return [
            'barcode.required' => 'Please provide number of barcode to generate.',
        ];
    }

    public function updatePrice()
    {
        // Update total based on stock and unit price
        $this->unit_price = $this->unit_price;
        $this->stock = $this->stock;
        $this->total = $this->unit_price * $this->stock;
    }
    public function category($value)
    {
        $product = Product::find($value);
        if($product->category->prefix)
        {
            $this->prefix = $product->category->prefix->prefix;
            $this->updateBarcodeValue();
        }
        else{
            $this->prefix='';
            $this->updateBarcodeValue();
        }
    }

    public function updateBarcodeValue()
    {
        $this->barcode = $this->barcode;
        $this->barcodeList = [];
        if($this->barcode)
        {
            // Generate barcodes
            for ($i = 1; $i <= $this->barcode; $i++) {
                if ($this->prefix) {
                    // If prefix is provided, use it
                    $barcode = $this->prefix . mt_rand(100000000, 999999999);
                } else {
                    // If no prefix, just generate a random barcode
                    $barcode = mt_rand(100000000, 999999999);
                }
                // Store barcode in the list
                $this->barcodeList[] = $barcode;
            }
        }
    }


    public function save()
    {
        $validated = $this->validate();
        sleep(1);
        $slug = Str::slug('STOCK'.'-'.$this->product_id.'-'.now());
        $item = ItemIn::create($validated+['company_id' => auth()->user()->company_id,'slug'=>$slug]);
        if($this->barcode)
        {
            // Save each generated barcode
            foreach ($this->barcodeList as $barcodeValue) {
                Barcode::create([
                    'company_id' => auth()->user()->company_id,
                    'item_in_id' => $item->id,
                    'barcode'    => $barcodeValue
                ]);
            }
        }
        $stockRecord = Stock::where('product_id', $this->product_id)->first();
        if ($stockRecord) {
            // If stock record exists, update the stock
            $stockRecord->update([
                'stock' => $stockRecord->stock + $this->stock
            ]);
        } else {
            // If stock record doesn't exist, create a new one
            Stock::create([
                'product_id' => $this->product_id,
                'company_id' => auth()->user()->company_id,
                'stock' => $this->stock,
            ]);
        }
        return redirect()->route('stocks')->with('message','Item stock in successfully.');
    }

    public function render()
    {
        $vendors = Vendor::select('id','name')->where('status','Active')->get();
        $products = Product::select('id','name')->where('status','Active')->get();
        return view('livewire.stock.create',compact('vendors','products'));
    }
}
