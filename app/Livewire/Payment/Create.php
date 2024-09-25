<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Vendor;
use App\Models\PaymentOut;
use App\Models\Cheque;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class Create extends Component
{
    use WithFileUploads;
    public $receipt_no;
    public $type;
    public $payment_date;
    public $withdraw_date;
    public $total;
    public $paid;
    public $cheque_no;
    public $vendor_id;
    public $image;
    public $slug;
    protected function rules()
    {
        $rules = [
            'vendor_id' => 'required',
            'receipt_no' => 'required',
            'type' => 'required',
            'payment_date' => 'required',
            'cheque_no' => 'nullable',
            'paid' => 'required',
            'image' => 'nullable|image|max:1024'
        ];
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



    public function save()
    {
        $validated = $this->validate();
        $vendor = Vendor::find($this->vendor_id);
        $this->total = ItemIn::where('vendor_id', $this->vendor_id)
        ->where('status', 'Pending')
        ->selectRaw('SUM(total) as total_sum')
        ->groupBy('vendor_id')
        ->first();
        $this->slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
        if($this->type === 'Cheque')
        {
            Cheque::create(['vendor_id'=>$this->vendor_id,'pay_date'=>$this->payment_date,'withdraw_date'=>$this->withdraw_date,'slug'=>$this->slug]);
        }
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('payments', $fileName, 'public');
            $validated['image'] = $filePath;
        }
        sleep(1);

        if ($this->total) {
            $previousRemain = PaymentOut::where('vendor_id',$this->vendor_id)->first();
            if(!$previousRemain)
            {
                PaymentOut::create($validated + ['total'=>$this->total->total_sum,'remain'=>$remain,'slug' => $this->slug]);
            }
            $check = (float)$this->total->total_sum + (float)$previousRemain->remain;
            if($check >= $this->paid)
            {
                $remain = (float)$this->total->total_sum - (float)$this->paid;
                //Update the pending status of the ItemIn
                ItemIn::where('vendor_id', $this->vendor_id)
                ->where('status', 'Pending') 
                ->update(['status' => 'Paid']); 
               
                // Create PaymentOut record with validated data
                PaymentOut::create($validated + ['total'=>$this->total->total_sum+$previousRemain->remain,'remain'=>$remain+$previousRemain->remain,'slug' => $this->slug]);
                $previousRemain->update(['remain'=>0]);
            }
            else{
                session()->flash('error', 'Total Amount is Rs.'. $check);
            }
        }
        else{
            
            $previousRemain = PaymentOut::where('vendor_id',$this->vendor_id)->where('remain','<>',0)->first();
            if($previousRemain)
            {
                if($this->paid == $previousRemain->remain)
                {
                    // Create PaymentOut record with validated data
                    PaymentOut::create($validated + ['total'=>$previousRemain->remain,'remain'=>0,'slug' => $this->slug]);
                    $previousRemain->update(['remain'=>0]);
                }
                else{
                    session()->flash('error', 'Previous Due remaining Rs.'. $previousRemain->remain);
                }
            }
            else{
                session()->flash('error', 'Not found/Amount Paid');
            }
        }
        // Display success message and reset form fields
        session()->flash('success', 'Payment data stored successfully');
        $this->reset();
    }
    public function showAmount($value)
    {
        
        if ($value) {
            $this->vendor_id = $value;
            $this->total = ItemIn::where('vendor_id', $value)
                ->where('status', 'Pending')
                ->selectRaw('SUM(total) as total_sum')
                ->groupBy('vendor_id')
                ->first();
            if (!$this->total) {
                $this->total = null;
            }
        } else {
            $this->total = null;
        }
    }

    public function payMethod($method)
    {
        $this->type= $method;
    }
    public function render()
    {
        $vendors = Vendor::select('id','name')->latest()->get();
        return view('livewire.payment.create',compact('vendors'));
    }
}
