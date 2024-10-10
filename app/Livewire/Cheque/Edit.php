<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Cheque;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Livewire\Attributes\On;

class Edit extends Component
{
    public $slug;
    use WithFileUploads;
    public $pay_date;
    public $withdraw_date;
    public $cheque_no;
    public $vendor_id;
    public $newImage;
    public $image;
    public $cheque;

    protected function rules()
    {
        return [
            'vendor_id' => 'required',
            'pay_date' => 'required',
            'cheque_no' => 'required',
            'withdraw_date' => 'required',
        ];
    }

    protected function messages()
    {
        return [
            'vendor_id.required'=>'Please select a vendor',
        ];
    }

    #[On('imaged-deleted')] 
    public function mount()
    {
        $this->cheque = Cheque::whereSlug($this->slug)->first();
        $this->withdraw_date = $this->cheque->withdraw_date;
        $this->vendor_id = $this->cheque->vendor_id;
        $this->pay_date = $this->cheque->pay_date;
        $this->cheque_no = $this->cheque->cheque_no;
        $this->image = $this->cheque->image;
    }

    public function updateImage()
    {
        if ($this->newImage) 
        {
            $fileName = $this->newImage->getClientOriginalName();
            $companyName = preg_replace('/[^A-Za-z0-9\-]/', '_', auth()->user()->company->name);
            $folderPath = 'payments/' . $companyName;
            $filePath = $this->newImage->storeAs($folderPath, $fileName, 'public');
            $this->newImage = 'payments/'.$companyName.'/' . $fileName;
            $this->cheque->update(['image' => $this->newImage]);
        }
    }

    public function deleteImage()
    {
        if (!empty($this->cheque->image)) {
            $image_path = public_path('storage/' . $this->cheque->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
            $this->cheque->update(['image' => '']);
            $this->dispatch('image-deleted')->self();
        }
    }

    public function update()
    {
        $validated = $this->validate();
        $vendor = Vendor::find($this->vendor_id);
        $slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
        $this->updateImage();
        sleep(1);
        $this->cheque->update(['vendor_id'=>$this->vendor_id,'image'=>$this->image ? $this->image : $this->newImage,'cheque_no'=>$this->cheque_no,'pay_date'=>$this->pay_date,'withdraw_date'=>$this->withdraw_date,'company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('cheques')->with('message','Cheque record updated successfully');
    }

    public function render()
    {
        $vendors = Vendor::latest()->select('id','name')->where('status','Active')->get();
        return view('livewire.cheque.edit',compact('vendors'));
    }
}
