<?php

namespace App\Livewire\Inventory;

use Livewire\Component;
use App\Models\Product;
use App\Models\Service;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Gate;

class Bin extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function restoreProduct($id)
    {
        if (Gate::allows('action-delete')) {
            $product = Product::find($id);
            $product->update(['status' => 'Active']);
            session()->flash('success', 'Product restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error', 'You do not have permission to restore.');
        }
    }
    public function restoreService($id)
    {
        if (Gate::allows('action-delete')) {
            $service = Service::find($id);
            $service->update(['status' => 'Active']);
            session()->flash('success', 'Service restored successfully');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error', 'You do not have permission to restore.');
        }
    }
    

    public function render()
    {
        $products = Product::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhereHas('category', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  });
        })->where('status','Inactive')->paginate($this->page);
        $services = Service::where(function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })->where('status','Inactive')->paginate($this->page);
        return view('livewire.inventory.bin',['products'=>$products,'services'=>$services]);
    }
}
