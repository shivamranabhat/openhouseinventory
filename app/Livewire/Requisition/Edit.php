<?php

namespace App\Livewire\Requisition;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Stock;
use App\Models\Requisition;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Edit extends Component
{
    #[Validate('required')]
    public $quantity;
    #[Validate('required')]
    public $item_in_id;
    public $slug;
    public $requisition;

    // For editing, pre-fill data
    public function mount($slug = null)
    {
        if ($slug) {
            $this->slug = $slug;
            $this->requisition = Requisition::whereSlug($slug)->first();

            if ($this->requisition) {
                $this->quantity = $this->requisition->quantity;
                $this->item_in_id = $this->requisition->item_in_id;
            }
        }
    }

    // Method to check the stock
    public function checkQuantity()
    {
        $item = ItemIn::find($this->item_in_id);
        $product = Stock::where('product_id', $item->product_id)->first();
        $currentStock = $product->stock;
        $requestStock = $this->quantity;
        if ($currentStock >= $requestStock) {
            // Stock is available
        } else {
            session()->flash('stock', 'Stock alert! Requested quantity is not available');
        }
    }

    public function update()
    {
        $validated = $this->validate();
        $createdAt = Carbon::now('Asia/Kathmandu');
        sleep(1);
        $slug = Str::slug('REQ' . '-' . $this->quantity . '-' . now());

        $item = ItemIn::find($this->item_in_id);
        $product = Stock::where('product_id', $item->product_id)->first();
        $currentStock = $product->stock;
        $requestStock = $this->quantity;

        // Check if stock is enough
        if ($currentStock >= $requestStock) {
            $updatedStock = $currentStock - $requestStock;

            if ($this->requisition->id) {
                // Edit operation
                $requisition = Requisition::find($this->requisition->id);
                $previousQuantity = $requisition->quantity;
                
                // Revert stock to the previous state
                $product->update(['stock' => $product->stock + $previousQuantity]);

                // Update stock based on new request quantity
                $product->update(['stock' => $product->stock - $this->quantity]);

                // Update requisition
                $requisition->update($validated + [
                    'slug' => $slug,
                    'employee_id' => auth()->user()->employee->id,
                    'company_id' => auth()->user()->company_id,
                    'created_at' => $createdAt
                ]);

                return redirect()->route('requisitions')->with('message','Request sent successfully.');
            } else {
                // Create operation
                $item->update(['stock' => $updatedStock]);
                Requisition::create($validated + [
                    'company_id' => auth()->user()->company_id,
                    'slug' => $slug,
                    'employee_id' => auth()->user()->employee->id,
                    'created_at' => $createdAt
                ]);
                return redirect()->route('requisitions')->with('message','Request sent successfully.');
            }
            return redirect()->route('requisitions');
        } else {
            session()->flash('error', 'Stock alert! Requested quantity is not available');
        }
    }

    public function render()
    {
        // Fetch latest stocks
        $stocks = ItemIn::selectRaw('MAX(id) as id, product_id')
            ->groupBy('product_id')
            ->latest()
            ->get();

        return view('livewire.requisition.edit', compact('stocks'));
    }
}
