<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\ItemIn;
use App\Models\Vendor;
use App\Models\PaymentOut;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $receipt_no;
    public $type;
    public $payment_date;
    public $total;
    public $paid;
    public $cheque_no;
    public $vendor_id;
    public $image;
    public $payment;

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
    
    public function mount()
    {
        $this->payment = PaymentOut::whereSlug($this->slug)->first();
        $this->vendor_id = $this->payment->vendor_id;
        $this->receipt_no = $this->payment->receipt_no;
        $this->type = $this->payment->type;
        $this->payment_date = $this->payment->payment_date;
        $this->cheque_no = $this->payment->cheque_no;
        $this->paid = $this->payment->paid;
        $this->image = $this->payment->image;
    }
    public function payMethod($value)
    {
        $this->type= $value;
    }
    public function update(PaymentOut $paymentOut)
    {
        // Validate the input data
        $validated = $this->validate();
    
        // Find the vendor
        $vendor = Vendor::find($this->vendor_id);
    
        // Calculate the total amount for pending status
        $this->total = ItemIn::where('vendor_id', $this->vendor_id)
            ->where('status', 'Pending')
            ->selectRaw('SUM(total) as total_sum')
            ->groupBy('vendor_id')
            ->first();
    
        // Generate a unique slug if required
        $slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
    
        // Handle image upload if exists
        if ($this->image) {
            // Delete the old image if a new one is uploaded
            if ($paymentOut->image) {
                \Storage::disk('public')->delete($paymentOut->image);
            }
            $fileName = $this->image->getClientOriginalName();
            $filePath = $this->image->storeAs('payments', $fileName, 'public');
            $validated['image'] = $filePath;
        } else {
            // Keep the existing image if no new image is uploaded
            $validated['image'] = $paymentOut->image;
        }
    
        // Delay for 1 second
        sleep(1);
    
        // Logic to handle updating the payment
        if ($this->total) {
            $previousRemain = PaymentOut::where('vendor_id', $this->vendor_id)->first();
    
            $check = (float)$this->total->total_sum + (float)$previousRemain->remain;
    
            if ($check >= (float)$this->paid) {
                $remain = (float)$this->total->total_sum - (float)$this->paid;
    
                // Update the status of the ItemIn to "Paid"
                ItemIn::where('vendor_id', $this->vendor_id)
                    ->where('status', 'Pending')
                    ->update(['status' => 'Paid']);
    
                // Update the existing PaymentOut record
                $paymentOut->update($validated + [
                    'total' => $this->total->total_sum + $previousRemain->remain,
                    'remain' => $remain + $previousRemain->remain,
                    'slug' => $slug,
                ]);
    
                // Set the previous remaining amount to 0
                $previousRemain->update(['remain' => 0]);
    
            } else {
                session()->flash('error', 'Total Amount is Rs. ' . $check);
                return;
            }
        } else {
            // Handle cases where no new total is found, but previous remains exist
            $previousRemain = PaymentOut::where('vendor_id', $this->vendor_id)
                ->where('remain', '<>', 0)
                ->first();
    
            if (!$previousRemain) {
                session()->flash('error', 'Not found/Amount Paid');
                return;
            }
    
            if ($this->paid == $previousRemain->remain) {
                // Update the existing PaymentOut record for the remaining amount
                $paymentOut->update($validated + [
                    'total' => $previousRemain->remain,
                    'remain' => 0,
                    'slug' => $slug,
                ]);
    
                // Set the remaining amount to 0
                $previousRemain->update(['remain' => 0]);
    
            } else {
                session()->flash('error', 'Previous Due remaining Rs. ' . $previousRemain->remain);
                return;
            }
        }
    
        // After successful update, reset the form and display a success message
        session()->flash('success', 'Payment data updated successfully');
        $this->reset();
    }
    
    public function render()
    {
        $vendors = Vendor::select('id','name')->latest()->get();
        return view('livewire.payment.edit',compact('vendors'));
    }
}
