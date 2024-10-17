<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Stock;
use App\Models\StockOut;
use App\Models\ItemIn;
use App\Models\Product;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PageController extends Controller
{
   
 
    public function department()
    {
        if (Gate::allows('action-create')) {
            return view('pages.department.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function departmentCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.department.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function departmentEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.department.edit',compact('slug'));
        } 
        else 
        {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function vendor()
    {
        if (Gate::allows('action-create')) {
            return view('pages.vendor.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function vendorCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.vendor.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function transaction($slug)
    {
        if (Gate::allows('action-create')) {
            return view('pages.vendor.transaction',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function vendorEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.vendor.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function category()
    {
        if (Gate::allows('action-create')) {
            return view('pages.category.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function categoryCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.category.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }

    }
    public function categoryEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.category.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function cheque()
    {
        if (Gate::allows('action-create')) {
            return view('pages.cheque.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function chequeCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.cheque.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function chequeEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.cheque.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function charge()
    {
        if (Gate::allows('action-create')) {
            return view('pages.charge.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function chargeCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.charge.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function chargeEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.charge.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function inventory()
    {
        if (Gate::allows('action-create')) {
            return view('pages.inventory.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function inventoryCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.inventory.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function inventoryEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.inventory.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function service()
    {
        if (Gate::allows('action-create')) {
            return view('pages.service.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function serviceCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.service.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function serviceEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.service.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function employee()
    {
        if (Gate::allows('action-create')) {
            return view('pages.employee.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function employeeCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.employee.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function employeeEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.employee.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function stock()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
   
    public function stockCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        } 
    }
    public function stockEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.stock.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        } 
    }
    public function stockOut()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock_out.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function stockOutUpload()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock_out.upload');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to upload.');
        }
    }
    public function stockOutCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.stock_out.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        } 
    }
    public function stockOutEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.stock_out.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        } 
    }
    public function credit()
    {
        if (Gate::allows('action-create')) {
            return view('pages.credit.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function creditCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.credit.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        } 
    }
    public function creditEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.credit.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        } 
    }
    public function prefix()
    {
        if (Gate::allows('action-create')) {
            return view('pages.prefix.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function prefixCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.prefix.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function prefixEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.prefix.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function bill()
    {
        if (Gate::allows('action-create')) {
            return view('pages.bill.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function billPreview($slug)
    {
        if (Gate::allows('action-create')) {
            return view('pages.bill.preview',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function billCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.bill.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        } 
    }
    public function billEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.bill.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function payment()
    {
        if (Gate::allows('action-create')) {
            return view('pages.payment.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function paymentPreview($slug)
    {
        if (Gate::allows('action-create')) {
            return view('pages.payment.preview',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to preview.');
        }
    }
    public function paymentCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.payment.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
        
    }
    public function paymentEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.payment.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
        
    }
    public function account()
    {
        if (Gate::allows('action-create')) {
            return view('pages.account.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to view.');
        }
    }
    public function accountCreate()
    {
        if (Gate::allows('action-create')) {
            return view('pages.account.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to create.');
        }
    }
    public function accountEdit($slug)
    {
        if (Gate::allows('action-edit')) {
            return view('pages.account.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to edit.');
        }
    }
    public function requisition()
    {
        return view('pages.requisition.index');
    }
    public function requisitionCreate()
    {
        if(auth()->user()->employee_id !==null)
        {
            return view('pages.requisition.create');
        }
        else{
            return redirect()->back()->with('error','Only employees are allowed.');
        }
    }
    public function requisitionEdit($slug)
    {
        return view('pages.requisition.edit',compact('slug'));
    }
    public function login()
    {
        return view('pages.auth.login');
    }
    public function profile()
    {
        return view('pages.auth.profile');
    }
    public function signup()
    {
        return view('pages.auth.signup');
    }
   
    public function testimonial()
    {
        if (Gate::allows('super-admin')) 
        {
           return view('pages.testimonial.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function testimonialCreate()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.testimonial.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function testimonialEdit($slug)
    {
        if (Gate::allows('super-admin')) {
            return view('pages.testimonial.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function content()
    {
        if (Gate::allows('super-admin')) 
        {
           return view('pages.content.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function contentCreate()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.content.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function contentEdit($slug)
    {
        if (Gate::allows('super-admin')) {
            return view('pages.content.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function feature()
    {
        if (Gate::allows('super-admin')) 
        {
           return view('pages.feature.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function featureCreate()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.feature.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function featureEdit($slug)
    {
        if (Gate::allows('super-admin')) {
            return view('pages.feature.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function faq()
    {
        if (Gate::allows('super-admin')) 
        {
           return view('pages.faq.index');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function faqCreate()
    {
        if (Gate::allows('super-admin')) {
            return view('pages.faq.create');
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function faqEdit($slug)
    {
        if (Gate::allows('super-admin')) {
            return view('pages.faq.edit',compact('slug'));
        } else {
            // Handle unauthorized action
            return redirect()->back()->with('error','You do not have permission to access.');
        }
    }
    public function stockOutUploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);

        // Open the uploaded CSV file
        $handle = fopen($request->file('file')->getRealPath(), 'r');

        // Skip the header row if necessary
        fgetcsv($handle);

        // Process each row in the CSV
        while (($row = fgetcsv($handle, 1000, ',')) !== false) {
            $this->processRow($row);
        }

        fclose($handle);

        return redirect()->route('stockOuts')->with('success', 'Data imported successfully!');
        
    }
    private function processRow(array $row)
    {
        // Similar processing logic as before
        $productName = $row[1];
        $departmentName = $row[2];
        $quantity = (int)$row[3];

        $department = Department::where('name', $departmentName)->first();
        $product = Product::where('name', $productName)->first();

        if ($product) {
            $itemIn = ItemIn::where('product_id', $product->id)->first();
            if ($department && $itemIn) {
                $stockRecord = Stock::where('product_id', $product->id)->first();

                if ($stockRecord && $stockRecord->stock >= $quantity) {
                    StockOut::create([
                        'department_id' => $department->id,
                        'item_in_id' => $itemIn->id,
                        'company_id' => auth()->user()->company_id,
                        'quantity' => $quantity,
                        'slug' => \Str::slug($productName . '-' . now()),
                    ]);

                    $stockRecord->update([
                        'stock' => $stockRecord->stock - $quantity,
                    ]);
                }
            }
        }
    }
}
