<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Vendor;
use App\Models\PaymentOut;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;
    public $receipt_no;
    public $type;
    public $amount;
    public $payment_date;
    public $total;
    public $cheque_no;
    public $vendor_id;
    public $image;
    protected function rules()
    {
        $rules = [
            'vendor_id' => 'required|unique:employees,name',
            'receipt_no' => 'required',
            'type' => 'required',
            'payment_date' => 'required',
            'cheque_no' => 'nullable',
            'total' => 'required',
            'image' => 'nullable|image|max:1024'
        ];
        // if (in_array($this->type, ['Online Banking', 'Cheque'])) {
        //     $rules['image'] = 'required|image|max:1024';
        // } else {
        //     $rules['image'] = 'nullable|image|max:1024';
        // }
        if ($this->type === 'Cheque') {
            $rules['cheque_no'] = 'required';
        } else {
            $rules['cheque_no'] = 'nullable';
        }

        return $rules;
    }
    
    protected function messages()
    {
        return [
            'image.required' => 'The image is required for Online Banking or Cheque payments.',
            'cheque_no.required' => 'Cheque number is required when payment type is Cheque.',
        ];
    }

    // public function showAmount($value)
    // {
    //     if ($value) {
    //         $this->vendor_id = $value;
    //         $this->amount = ItemIn::where('vendor_id', $value)
    //             ->where('status', 'Pending')
    //             ->selectRaw('SUM(total) as total_sum')
    //             ->groupBy('vendor_id')
    //             ->first();
    //         if (!$this->amount) {
    //             $this->amount = null;
    //         }
    //     } else {
    //         $this->amount = null;
    //     }
    // }

    public function payMethod($value)
    {
        $this->type= $value;
    }
    public function save()
    {
        $validated = $this->validate();
        $vendor = Vendor::find($this->vendor_id);
        $slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('payments', $fileName, 'public');
            $validated['image'] = $filePath;  // Add the stored image path to the validated data
        }
        
        // Create PaymentOut record with validated data
        PaymentOut::create($validated + ['slug' => $slug]);
        
        // Display success message and reset form fields
        session()->flash('success', 'Payment data stored successfully');
        $this->reset();
    
    }
    public function render()
    {
        $vendors = Vendor::select('id','name')->latest()->get();
        return view('livewire.payment.create',compact('vendors'));
    }
}
