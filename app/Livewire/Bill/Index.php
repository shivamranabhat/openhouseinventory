<?php

namespace App\Livewire\Bill;

use Livewire\Component;
use App\Models\ItemIn;
use Livewire\WithPagination;
use Livewire\Attributes\Url;

class Index extends Component
{
    use WithPagination;
    #[Url] 
    public $search = '';
    public $page=10;

    public function updatePage($page)
    {
        $this->page = $page;
        $this->resetPage();
    }



    public function render()
    {
        $bills = ItemIn::where(function ($query) {
            $query->where('purchase_date', 'like', '%' . $this->search . '%')
            ->orWhere('rack_no', 'like', '%' . $this->search . '%')
                  ->orWhereHas('vendor', function($query) {
                      $query->where('name', 'like', '%' . $this->search . '%');
                  })->orWhereHas('product', function($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
        })->latest()->selectRaw('purchase_date, vendor_id,MAX(slug) as slug,SUM(total) as total_sum, COUNT(*) as total_count') // Select fields and aggregate count
        ->groupBy('purchase_date', 'vendor_id')
        ->paginate($this->page);
        return view('livewire.bill.index',['bills'=>$bills]);
    }
}
