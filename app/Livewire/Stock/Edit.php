<?php

namespace App\Livewire\Stock;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Barcode;
use App\Models\ItemIn;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class Edit extends Component
{
    public $slug;
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
    #[Validate('nullable')]
    public $prefix;
    #[Validate('nullable|numeric|min:1')]
    public $barcode;
    #[Validate('required')]
    public $purchase_date;
    #[Validate('nullable')]
    public $rack_no;
    public $barcodeList = [];
    public $existingBarcodes = [];
    public $item_in;

    public function updatePrice()
    {
        // Update total based on stock and unit price
        if ($this->stock && $this->unit_price) {
            $this->total = $this->unit_price * $this->stock;
        }
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

    public function regenerateBarcode()
    {
        // Ensure barcode is properly set
        $this->barcode = $this->barcode;
        
        // Clear the barcode list
        $this->barcodeList = [];

        if ($this->barcode) {
            // Generate barcodes
            for ($i = 1; $i <= $this->barcode; $i++) {
                if ($this->prefix) {
                    // If prefix is provided, use it and append a random number
                    $barcode = $this->prefix . mt_rand(100000000, 999999999);
                } else {
                    // If no prefix, just generate a random number as barcode
                    $barcode = mt_rand(100000000, 999999999);
                }

                // Store the generated barcode in the barcode list
                $this->barcodeList[] = $barcode;
            }
        }
    }
    public function updateBarcodeValue()
    {
        // Get the current count of existing barcodes
        $existingCount = count($this->existingBarcodes);
        // Check if the new input is greater than the existing barcode count
        if ($this->barcode > $existingCount) {
            // Add new barcodes to match the requested number
            $newBarcodesCount = $this->barcode - $existingCount;
    
            for ($i = 0; $i < $newBarcodesCount; $i++) {
                if ($this->prefix) {
                    $barcode = $this->prefix . mt_rand(100000000, 999999999);
                } else {
                    $barcode = mt_rand(100000000, 999999999);
                }
                $this->barcodeList[] = $barcode;  // Add new barcodes to the list
            }
        } elseif ($this->barcode < $existingCount) {
            // Remove barcodes to match the requested number
            $this->barcodeList = array_slice($this->existingBarcodes, 0, $this->barcode);
        } else {
            // If the count matches, no action is needed
            $this->barcodeList = $this->existingBarcodes;
        }
    }
    


    public function mount()
    {
        $this->item_in = ItemIn::whereSlug($this->slug)->first();
        $this->product_id = $this->item_in->product_id;
        $this->vendor_id = $this->item_in->vendor_id;
        $this->barcode_id = $this->item_in->barcode_id;
        $this->stock = $this->item_in->stock;
        $this->prefix = $this->item_in->prefix;
        $this->unit_price = $this->item_in->unit_price;
        $this->total = $this->item_in->total;
        $this->purchase_date = $this->item_in->purchase_date;
        $this->rack_no = $this->item_in->rack_no;
        $this->existingBarcodes = Barcode::where('item_in_id', $this->item_in->id)->pluck('barcode')->toArray();
        $this->barcode = count($this->existingBarcodes);
    }

    public function update()
    {
        $validated = $this->validate();
        $slug = Str::slug('STOCK'.'-'.$this->product_id.'-'.$this->stock);
        $item = ItemIn::updateOrCreate(
            ['slug' => $this->slug],  // Search by slug to update the existing item
            $validated + ['slug' => $slug]
        );
        
        if (!empty($this->barcodeList)) {
            // Delete old barcodes associated with the item
            Barcode::where('item_in_id', $item->id)->delete();
    
            // Save the new barcodes
            foreach ($this->barcodeList as $barcodeValue) {
                Barcode::create([
                    'item_in_id' => $item->id,
                    'barcode'    => $barcodeValue
                ]);
            }
        }
        sleep(1);
        session()->flash('success','Item stock in updated successfully');
    }

    public function render()
    {
        $vendors = Vendor::select('id','name')->get();
        $products = Product::select('id','name')->get();
        return view('livewire.stock.edit',compact('vendors','products'));
    }
}
