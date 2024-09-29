<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\ExtraCharge;
use App\Models\ItemIn;
use App\Models\Bill;
use App\Models\BillProduct;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;

class Create extends Component
{
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
    public $extra_charge;

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
    public function mount()
    {
        $this->addRow();
        $this->slug = rand(1, 99999);
    }

    public function addRow()
    {
        $this->rows[] = ['item_in_id' => null, 'quantity' => 1, 'rate' => 0];
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
    // public function calculateGrandTotal()
    // {
    //     $subtotal = $this->calculateSubtotal();
    //     $totalWithTax = $subtotal + $subtotal *(($this->value)/100 ?? 0);
    //     return $totalWithTax;
    // }

    public function calculateGrandTotal()
    {
        $subtotal = $this->calculateSubtotal();
        $tax = $this->value ? ($subtotal * ($this->value / 100)) : 0;
        return $subtotal + $tax;
    }


    public function charge($value)
    {
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

    public function vendor($value)
    {
        $this->vendor_id = $value;
        if ($this->vendor_id) {
            // $this->items = ItemIn::where('vendor_id', $this->vendor_id)->latest()->get();
            $this->items = ItemIn::where('vendor_id', $this->vendor_id)
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('item_ins')
                    // ->where('status','Pending')
                    ->where('vendor_id', $this->vendor_id)
                    ->groupBy('vendor_id', 'product_id');
            })
            ->get();
        } else {
            $this->items = [];
        }
    }

    public function save()
    {
        $validated = $this->validate();
        $bill = Bill::create(['vendor_id'=>$this->vendor_id,'receipt_no'=>$this->receipt_no,'bill_date'=>$this->bill_date,'company_id' => auth()->user()->company_id,'slug'=>$this->slug]);
        foreach ($this->rows as $row) {
            // Create a new BillProduct instance and save data
            BillProduct::create([
                'bill_id'=>$bill->id,
                'item_in_id' => $row['item_in_id'],
                'quantity' => $row['quantity'],
                'rate' => $row['rate'],
                'company_id' => auth()->user()->company_id,
                'extra_charge_id' => $this->extra_charge ? $this->extra_charge->id : null
            ]);
        }
        session()->flash('success','Bill created successfully');
        $this->reset(['receipt_no', 'bill_date', 'rows', 'extra_charge']);
        $this->reset();
    }

    public function render()
    {
        $vendors = Vendor::select('name', 'id')->latest()->get();
        $charges = ExtraCharge::select('name', 'value', 'id')->get();
        return view('livewire.bill.create', compact('vendors', 'charges'));
    }
}