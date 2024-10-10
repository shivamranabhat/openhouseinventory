<?php

namespace App\Livewire\Cheque;

use Livewire\Component;
use App\Models\Vendor;
use App\Models\Cheque;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $pay_date;
    public $withdraw_date;
    public $cheque_no;
    public $vendor_id;
    public $image;

    protected function rules()
    {
        return [
            'vendor_id' => 'required',
            'pay_date' => 'required',
            'cheque_no' => 'required',
            'withdraw_date' => 'required',
            'image' => 'required|image|max:1024'
        ];
    }

    protected function messages()
    {
        return [
            'vendor_id.required'=>'Please select a vendor',
            'image.required' => 'The image is required for Cheque payments.',
        ];
    }

    public function save()
    {
        $validated = $this->validate();
        $vendor = Vendor::find($this->vendor_id);
        $slug = Str::slug('PAY'.'-'.$vendor->name.'-'.now());
        if ($this->image) {
            $fileName = $this->image->getClientOriginalName();
            $companyName = preg_replace('/[^A-Za-z0-9\-]/', '_', auth()->user()->company->name);
            $folderPath = 'payments/' . $companyName;
            $filePath = $this->image->storeAs($folderPath, $fileName, 'public');
            $validated['image'] = $filePath;
        }
        sleep(1);
        Cheque::create(['vendor_id'=>$this->vendor_id,'image'=>$validated['image'],'cheque_no'=>$this->cheque_no,'pay_date'=>$this->pay_date,'withdraw_date'=>$this->withdraw_date,'company_id' => auth()->user()->company_id,'slug'=>$slug]);
        return redirect()->route('cheques')->with('message','Cheque record added successfully');
    }
    public function render()
    {
        $vendors = Vendor::latest()->select('id','name')->where('status','Active')->get();
        return view('livewire.cheque.create',compact('vendors'));
    }
}
