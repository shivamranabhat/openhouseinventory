<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\ExtraCharge;
use App\Models\ItemIn;
use App\Models\Bill;
use App\Models\BillProduct;

class Edit extends Component
{
    public $bill;
    public $vendor_id;
    public $item_in_id;
    public $items = [];
    public $quantity = [];
    public $rate = [];
    public $rows = [];
    public $type;
    public $value;
    public $bill_date;
    public $receipt_no;
    public $slug;
    public $billProduct;
    public $extra_charge_id;
    public $extra_charge;
    public $charges = [];

    protected function rules()
    {
        return [
            'vendor_id' => 'required',
            'rows.*.item_in_id' => 'required',
            'rows.*.quantity' => 'required|numeric|min:1',
            'rows.*.rate' => 'required|numeric|min:0.01',
            'bill_date' => 'required',
            'receipt_no' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'vendor_id.required' => 'Please choose a vendor.',
            'rows.*.item_in_id.required' => 'Please choose an item.',
            'rows.*.quantity.required' => 'Please enter a valid quantity.',
            'rows.*.quantity.numeric' => 'Quantity must be a number.',
            'rows.*.quantity.min' => 'Quantity must be at least 1.',
            'rows.*.rate.required' => 'Please enter a valid rate.',
            'rows.*.rate.numeric' => 'Rate must be a number.',
            'rows.*.rate.min' => 'Rate must be at least 0.01.',
            'bill_date.required' => 'Please enter a valid date',
            'receipt_no.required' => 'Please enter a receipt number',
        ];
    }

    public function mount($slug)
    {
        $this->bill = Bill::whereSlug($slug)->with('billProducts')->firstOrFail();

        // Populate existing data
        $this->vendor_id = $this->bill->vendor_id;
        $this->receipt_no = $this->bill->receipt_no;
        $this->bill_date = $this->bill->bill_date;
        $this->slug = $this->bill->slug;

        // Populate rows with BillProduct data
        foreach ($this->bill->billProducts as $product) {
            $this->rows[] = [
                'item_in_id' => $product->item_in_id,
                'quantity' => $product->quantity,
                'rate' => $product->rate,
                'extra_charge_id' => $product->extra_charge_id,
                'product_name' => $product->itemIn->product->name,
                'sku' => $product->itemIn->product->sku,
            ];
        }

        $this->items = ItemIn::where('vendor_id', $this->vendor_id)->get();
        $this->billProduct = $this->bill->billProducts->first(); // Adjust this to match your logic
   
        // Assign the extra_charge_id from the billProduct
        if($this->billProduct->extra_charge_id)
        {
            $this->extra_charge_id = $this->billProduct->extra_charge_id;
            $this->extra_charge = ExtraCharge::find($this->extra_charge_id);
            $this->type = $this->extra_charge->name;
            $this->value = $this->extra_charge->value;
        }
        // Fetch available extra charges
        $this->charges = ExtraCharge::all();
        $this->items = ItemIn::where('vendor_id', $this->vendor_id)
        ->whereIn('id', function ($query) {
            $query->selectRaw('MAX(id)')
                ->from('item_ins')
                ->where('vendor_id', $this->vendor_id)
                ->groupBy('vendor_id', 'product_id');
        })
        ->get();
    }

    public function charge($value)
    {
        // Update the selected extra charge ID
        $this->extra_charge_id = $value;
        $this->extra_charge = ExtraCharge::find($value);
        if($this->extra_charge)
        {
            $this->type = $this->extra_charge->name;
            $this->value = $this->extra_charge->value;
        }
        else{
            $this->type = '';
            $this->value = (int) 0;
        }
    }

    // public function charge($value)
    // {
    //     $this->extra_charge = ExtraCharge::find($value);
    //     $this->type = $this->extra_charge->name;
    //     $this->value = $this->extra_charge->value;
    // }
    
    public function addRow()
    {
        $this->rows[] = [ 'product_name' => '','item_in_id' => null, 'quantity' => 1, 'rate' => 0,'sku'=>''];
    }

    public function removeRow($index)
    {
        unset($this->rows[$index]);
        $this->rows = array_values($this->rows);
    }

    public function item($index, $id)
    {
        $item = ItemIn::find($id);
        if ($item) {
            $this->rows[$index]['quantity'] = $item->stock;
            $this->rows[$index]['rate'] = $item->unit_price;
        } else {
            $this->rows[$index]['quantity'] = '';
            $this->rows[$index]['rate'] = '';
        }
    }

    public function calculateTotal($index)
    {
        $quantity = (int) $this->rows[$index]['quantity'];
        $rate = (float) $this->rows[$index]['rate'];

        return $quantity * $rate;
    }

    public function calculateSubtotal()
    {
        $subtotal = 0;
        foreach ($this->rows as $index => $row) {
            $subtotal += $this->calculateTotal($index);
        }
        return $subtotal;
    }

    public function calculateGrandTotal()
    {
        $subtotal = $this->calculateSubtotal();
        $totalWithTax = $subtotal + $subtotal * (($this->value) / 100 ?? 0);
        return $totalWithTax;
    }

   

    public function vendor($value)
    {
        $this->vendor_id = $value;
        $this->items = ItemIn::where('vendor_id', $this->vendor_id)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('item_ins')
                    ->where('vendor_id', $this->vendor_id)
                    ->groupBy('vendor_id', 'product_id');
            })
            ->where('is_deleted','No')
            ->get();
    }

    public function save()
    {
        $validated = $this->validate();
        sleep(1.2);
        // Update the Bill
        $this->bill->update([
            'vendor_id' => $this->vendor_id,
            'receipt_no' => $this->receipt_no,
            'bill_date' => $this->bill_date,
            'slug' => $this->slug,
        ]);

        // Clear the existing BillProduct entries and create new ones
        BillProduct::where('bill_id', $this->bill->id)->delete();

        foreach ($this->rows as $row) {
            BillProduct::create([
                'bill_id' => $this->bill->id,
                'item_in_id' => $row['item_in_id'],
                'quantity' => $row['quantity'],
                'rate' => $row['rate'],
                'company_id' => auth()->user()->company_id,
                'extra_charge_id' => $this->extra_charge ? $this->extra_charge->id : null,
            ]);
            if($this->extra_charge)
            {
                ItemIn::find($row['item_in_id'])->update(['extra_charge_id'=>$this->extra_charge->id]);
            }
            else{
                ItemIn::find($row['item_in_id'])->update(['extra_charge_id'=>null]);
            }
        }
        sleep(1.2);
        return redirect()->route('bills')->with('message','Bill updated successfully.');
    }

    public function render()
    {
        $vendors = Vendor::select('name', 'id')->where('status','Active')->latest()->get();
        $charges = ExtraCharge::select('name', 'value', 'id')->where('status','Active')->get();
        return view('livewire.bill.edit', compact('vendors', 'charges'));
    }
}