<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\Cheque;
use App\Models\Vendor;
use App\Models\PaymentOut;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Edit extends Component
{
    use WithFileUploads;
    public $slug;
    public $receipt_no;
    public $type;
    public $payment_date;
    public $withdraw_date='';
    public $paid;
    public $cheque_no;
    public $vendor_id;
    public $image;
    public $newImage;
    public $payment;
    public $cheque;

    protected function rules()
    {
        $rules = [
            'vendor_id' => 'required',
            'receipt_no' => 'required',
            'type' => 'required',
            'payment_date' => 'required',
            'cheque_no' => 'nullable',
            'paid' => 'required',
            // 'image' => 'nullable|image|max:1024|mimes:jpg,png,webp,jpeg'
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
    #[On('imaged-deleted')] 
    public function mount()
    {
        $this->payment = PaymentOut::whereSlug($this->slug)->first();
        $this->cheque = Cheque::where('payment_out_id',$this->payment->id)->first();
        if($this->cheque)
        {
            $this->withdraw_date = $this->cheque->withdraw_date;
        }
        $this->vendor_id = $this->payment->vendor_id;
        $this->receipt_no = $this->payment->receipt_no;
        $this->type = $this->payment->type;
        $this->payment_date = $this->payment->payment_date;
        $this->cheque_no = $this->payment->cheque_no;
        $this->paid = $this->payment->paid;
        $this->image = $this->payment->image;
    }
   
    public function update()
    {
        $validated = $this->validate();

        $vendor = Vendor::find($this->vendor_id);

        $slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
        $newAmount = $this->paid;
        $prevAmount = $this->payment->paid;
        $this->updateImage();
        if($newAmount >=$prevAmount)
        {
            $updatedAmount = (int)$newAmount - (int)$prevAmount;
            if($this->payment->remain>=$updatedAmount)
            {
                $updatedRemain = (int) $this->payment->remain - (int) $updatedAmount;
                $this->payment->update([
                    'vendor_id'=>$this->vendor_id,
                    'receipt_no'=>$this->receipt_no,
                    'type'=>$this->type,
                    'payment_date'=>$this->payment_date,
                    'cheque_no'=>$this->cheque_no,
                    'paid'=>$newAmount,
                    'remain'=>$updatedRemain,
                ]);
                if ($this->type === 'Cash' || $this->type==='Online Banking')
                {
                    if($this->cheque)
                    {
                        $this->cheque->delete();
                    }
                    $this->payment->update([
                        'cheque_no'=>'',
                    ]);
                }
                if ($this->type === 'Cash')
                {
                    $this->deleteImage();
                }
                if ($this->type === 'Cheque') {
                    Cheque::updateOrCreate(
                        [
                            'payment_out_id' => $this->payment->id, 
                        ],
                        [
                            'vendor_id' => $this->vendor_id, 
                            'pay_date' => $this->payment_date,
                            'withdraw_date' => $this->withdraw_date,
                            'slug' => $slug,
                        ]
                    );
                }
                sleep(1);
        
                session()->flash('success', 'Payment data updated successfully');
            }
            else{
                session()->flash('error', 'This value is greater than remaining amount.');
            }
        }
        else{
            session()->flash('error', 'This value is less than remaining amount.');
        }
       
    }

    public function updateImage()
    {
        if ($this->newImage) 
        {
            $fileName = $this->newImage->getClientOriginalName();
            $filePath = $this->newImage->storeAs('payments', $fileName, 'public');
            $this->newImage = 'payments/' . $fileName;
            $this->payment->update(['image' => $this->newImage]);
        }
    }

    public function deleteImage()
    {
        if (!empty($this->payment->image)) {
            $image_path = public_path('storage/' . $this->payment->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->payment->update(['image' => '']);
            $this->dispatch('image-deleted')->self();
        }
    }

    public function payMethod($value)
    {
        $this->type= $value;
    }
    public function render()
    {
        $vendors = Vendor::select('id','name')->latest()->get();
        return view('livewire.payment.edit',compact('vendors'));
    }
}
